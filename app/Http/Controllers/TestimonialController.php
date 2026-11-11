<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialRequest;
use App\Models\TestimonialModel;
use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends Controller
{
    use CommonFunctions;

    /**
     * Show the testimonial slider page
     */
    public function testimonialSlider()
    {
        return view("Dashboard.Pages.testimonial");
    }

    /**
     * Return testimonial data for DataTables
     */
    public function testimonialData()
    {
        $query = TestimonialModel::select(
            TestimonialModel::ID,
            TestimonialModel::IMAGE,
            TestimonialModel::HEADING_MIDDLE,
            TestimonialModel::HEADING_BOTTOM,
            TestimonialModel::YOUTUBE_LINK,
            TestimonialModel::SLIDE_SORTING,
            TestimonialModel::SLIDE_STATUS
        );

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btnEdit = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                $btnDisable = ' <a href="javascript:void(0)" onclick="Disable(' . $row->{TestimonialModel::ID} . ')" class="btn btn-danger btn-sm">Disable Slide</a>';
                $btnEnable = ' <a href="javascript:void(0)" onclick="Enable(' . $row->{TestimonialModel::ID} . ')" class="btn btn-primary btn-sm">Enable Slide</a>';

                return $row->{TestimonialModel::SLIDE_STATUS} == TestimonialModel::SLIDE_STATUS_DISABLED
                    ? $btnEdit . $btnEnable
                    : $btnEdit . $btnDisable;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Save, update or toggle enable/disable testimonial slide
     */
    public function testimonialSaveSlide(TestimonialRequest $request)
    {
        try {
            switch ($request->input("action")) {
                case "insert":
                    $return = $this->insertSlide($request);
                    break;
                case "update":
                    $return = $this->updateSlide($request);
                    break;
                case "enable":
                case "disable":
                    $return = $this->enableDisableSlide($request);
                    break;
                default:
                    $return = ["status" => false, "message" => "Unknown action", "data" => ""];
            }
        } catch (Exception $exception) {
            $return = $this->reportException($exception);
        }

        return response()->json($return);
    }

    /**
     * Insert new testimonial slide
     */
    public function insertSlide(TestimonialRequest $request)
    {
        $TestimonialModel = new TestimonialModel();

        // Handle image upload
        if ($request->hasFile(TestimonialModel::IMAGE)) {
            $path = $request->file(TestimonialModel::IMAGE)->store('testimonial_images', 'public');
            $TestimonialModel->{TestimonialModel::IMAGE} = $path;
        }

        $TestimonialModel->{TestimonialModel::HEADING_MIDDLE} = $request->input(TestimonialModel::HEADING_MIDDLE);
        $TestimonialModel->{TestimonialModel::HEADING_BOTTOM} = $request->input(TestimonialModel::HEADING_BOTTOM);

        // ✅ Extract YouTube ID from full URL
        $TestimonialModel->{TestimonialModel::YOUTUBE_LINK} = $this->extractYoutubeId(
            $request->input(TestimonialModel::YOUTUBE_LINK)
        );

        $TestimonialModel->{TestimonialModel::SLIDE_STATUS} = $request->input(TestimonialModel::SLIDE_STATUS);
        $TestimonialModel->{TestimonialModel::SLIDE_SORTING} = $request->input(TestimonialModel::SLIDE_SORTING);
        $TestimonialModel->{TestimonialModel::STATUS} = 1;
        $TestimonialModel->{TestimonialModel::CREATED_BY} = Auth::user()->id;

        $TestimonialModel->save();
        $this->forgetSlides();

        return ["status" => true, "message" => "Saved successfully", "data" => null];
    }

    /**
     * Update existing testimonial slide
     */
    public function updateSlide(TestimonialRequest $request)
    {
        $check = TestimonialModel::where([TestimonialModel::ID => $request->input(TestimonialModel::ID), TestimonialModel::STATUS => 1])->first();

        if ($check) {
            // Handle image update
            if ($request->hasFile(TestimonialModel::IMAGE)) {
                if ($check->{TestimonialModel::IMAGE}) {
                    Storage::disk('public')->delete($check->{TestimonialModel::IMAGE});
                }
                $path = $request->file(TestimonialModel::IMAGE)->store('testimonial_images', 'public');
                $check->{TestimonialModel::IMAGE} = $path;
            }

            $check->{TestimonialModel::HEADING_MIDDLE} = $request->input(TestimonialModel::HEADING_MIDDLE);
            $check->{TestimonialModel::HEADING_BOTTOM} = $request->input(TestimonialModel::HEADING_BOTTOM);

            // ✅ Extract YouTube ID from full URL
            $check->{TestimonialModel::YOUTUBE_LINK} = $this->extractYoutubeId(
                $request->input(TestimonialModel::YOUTUBE_LINK)
            );

            $check->{TestimonialModel::SLIDE_STATUS} = $request->input(TestimonialModel::SLIDE_STATUS);
            $check->{TestimonialModel::SLIDE_SORTING} = $request->input(TestimonialModel::SLIDE_SORTING);
            $check->{TestimonialModel::UPDATED_BY} = Auth::user()->id;

            $check->save();
            $this->forgetSlides();

            return ["status" => true, "message" => "Updated successfully", "data" => null];
        } else {
            return ["status" => false, "message" => "Details not found.", "data" => null];
        }
    }


    /**
     * Enable or disable a slide
     */
    public function enableDisableSlide(TestimonialRequest $request)
    {
        $slide = TestimonialModel::find($request->input(TestimonialModel::ID));

        if (!$slide) {
            return ["status" => false, "message" => "Slide not found", "data" => ""];
        }

        $slide->{TestimonialModel::UPDATED_BY} = Auth::user()->id;
        $slide->{TestimonialModel::SLIDE_STATUS} = $request->input("action") == "enable"
            ? TestimonialModel::SLIDE_STATUS_LIVE
            : TestimonialModel::SLIDE_STATUS_DISABLED;

        $slide->save();
        $this->forgetSlides();

        return ["status" => true, "message" => ucfirst($request->input("action")) . "d successfully", "data" => ""];
    }

    /**
     * Extract YouTube video ID from URL or ID
     */
    private function extractYoutubeId($urlOrId)
    {
        preg_match("/(?:v=|\/)([a-zA-Z0-9_-]{11})/", $urlOrId, $matches);
        return $matches[1] ?? $urlOrId;
    }
}
