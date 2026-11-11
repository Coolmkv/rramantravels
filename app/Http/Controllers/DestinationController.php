<?php
namespace App\Http\Controllers;

use App\Http\Requests\DestinationMasterRequest;
use App\Models\DestinationsModel;
use App\Traits\CommonFunctions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class DestinationController extends Controller
{
    use CommonFunctions;

    public function destinationMaster()
    {
        return view("Dashboard.Pages.destinationsAdmin");
    }

    public function saveDestinations(DestinationMasterRequest $request)
    {
        Cache::forget('destination_master');
        switch ($request->input("action")) {
            case "insert":
                $return = $this->insertDestination($request);
                break;
            case "update":
                $return = $this->updateDestination($request);
                break;
            case "enable":
                $return = $this->toggleDestinationStatus($request, 1);
                break;
            case "disable":
                $return = $this->toggleDestinationStatus($request, 0);
                break;
            default:
                $return = ["status" => false, "message" => "Unknown action.", "data" => null];
        }
        return response()->json($return);
    }

    public function insertDestination(DestinationMasterRequest $request)
    {
        $checkDuplicate = DestinationsModel::where(DestinationsModel::DESTINATION_NAME, $request->input(DestinationsModel::DESTINATION_NAME))->first();
        $images = [];

        if ($request->hasFile(DestinationsModel::DESTINATION_IMAGE)) {
            $images = $this->uploadMultipleImages($request, DestinationsModel::DESTINATION_IMAGE);
            $images = array_unique($images);
        }

        if ($checkDuplicate) {
            return $this->returnMessage("Destination name is already taken");
        } else {
            $createNewDestination = new DestinationsModel();
            if (!empty($images)) {
                $createNewDestination->{DestinationsModel::DESTINATION_IMAGE} = json_encode($images);
            }

            $createNewDestination->{DestinationsModel::DESTINATION_NAME} = $request->input(DestinationsModel::DESTINATION_NAME);
            $createNewDestination->{DestinationsModel::DESTINATION_DETAILS} = $request->input(DestinationsModel::DESTINATION_DETAILS);
            $createNewDestination->{DestinationsModel::POSITION} = $request->input(DestinationsModel::POSITION);
            $createNewDestination->{DestinationsModel::META_TITLE} = $request->input(DestinationsModel::META_TITLE);
            $createNewDestination->{DestinationsModel::META_KEYWORD} = $request->input(DestinationsModel::META_KEYWORD);
            $createNewDestination->{DestinationsModel::META_DESCRIPTION} = $request->input(DestinationsModel::META_DESCRIPTION);
            $createNewDestination->{DestinationsModel::STATUS} = $request->input("status", 1);
            $createNewDestination->{DestinationsModel::CREATED_BY} = Auth::user()->id;
            $createNewDestination->save();

            return $this->returnMessage("Saved successfully.", true);
        }
    }

    public function uploadMultipleImages(FormRequest $request, $fieldName)
    {
        $images = [];
        if ($request->hasFile($fieldName)) {
            foreach ($request->file($fieldName) as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('website/uploads/destination_images', $filename, 'public');
                $images[] = $path;
            }
        }
        return $images;
    }

    public function updateDestination(DestinationMasterRequest $request)
    {
        $checkDuplicate = DestinationsModel::where(DestinationsModel::DESTINATION_NAME, $request->input(DestinationsModel::DESTINATION_NAME))
            ->where(DestinationsModel::ID, "<>", $request->input(DestinationsModel::ID))->first();

        if ($checkDuplicate) {
            return $this->returnMessage("Destination name is already taken");
        } else {
            $updateModel = DestinationsModel::find($request->input(DestinationsModel::ID));
            $images = [];

            // New images uploaded
            if ($request->hasFile(DestinationsModel::DESTINATION_IMAGE)) {
                $images = $this->uploadMultipleImages($request, DestinationsModel::DESTINATION_IMAGE);
                $images = array_unique($images);
                if (!empty($images)) {
                    $updateModel->{DestinationsModel::DESTINATION_IMAGE} = json_encode($images);
                }
            } else {
                // Keep old images if no new upload
                if ($updateModel->{DestinationsModel::DESTINATION_IMAGE}) {
                    $updateModel->{DestinationsModel::DESTINATION_IMAGE} = $updateModel->{DestinationsModel::DESTINATION_IMAGE};
                }
            }

            $updateModel->{DestinationsModel::DESTINATION_NAME} = $request->input(DestinationsModel::DESTINATION_NAME);
            $updateModel->{DestinationsModel::POSITION} = $request->input(DestinationsModel::POSITION);
            $updateModel->{DestinationsModel::DESTINATION_DETAILS} = $request->input(DestinationsModel::DESTINATION_DETAILS);
            $updateModel->{DestinationsModel::META_TITLE} = $request->input(DestinationsModel::META_TITLE);
            $updateModel->{DestinationsModel::META_KEYWORD} = $request->input(DestinationsModel::META_KEYWORD);
            $updateModel->{DestinationsModel::META_DESCRIPTION} = $request->input(DestinationsModel::META_DESCRIPTION);
            $updateModel->{DestinationsModel::STATUS} = $request->input("status", 1);
            $updateModel->{DestinationsModel::UPDATED_BY} = Auth::user()->id;
            $updateModel->save();

            return $this->returnMessage("Updated successfully.", true);
        }
    }

    // Unified toggle function
    public function toggleDestinationStatus(DestinationMasterRequest $request, $status)
    {
        $destination = DestinationsModel::find($request->input(DestinationsModel::ID));
        if ($destination) {
            $destination->{DestinationsModel::STATUS} = $status;
            $destination->{DestinationsModel::UPDATED_BY} = Auth::user()->id;
            $destination->save();
            $msg = $status ? "Enabled successfully." : "Disabled successfully.";
            return $this->returnMessage($msg, true);
        } else {
            return $this->returnMessage("Destination not found.");
        }
    }

    public function destinationsData()
    {
        $query = DestinationsModel::select(
            DestinationsModel::DESTINATION_NAME,
            DestinationsModel::DESTINATION_IMAGE,
            DestinationsModel::DESTINATION_DETAILS,
            DestinationsModel::META_TITLE,
            DestinationsModel::META_KEYWORD,
            DestinationsModel::META_DESCRIPTION,
            DestinationsModel::POSITION,
            DestinationsModel::STATUS,
            DestinationsModel::ID
        );

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('destination_image', function ($row) {
                $images = is_string($row->destination_image) ? json_decode($row->destination_image, true) : $row->destination_image;
                if (is_array($images) && !empty($images)) {
                    $html = '';
                    foreach ($images as $image) {
                        $html .= '<img src="' . asset('storage/' . $image) . '" class="img-thumbnail" style="max-width: 100px; margin-right: 5px;">';
                    }
                    return $html;
                }
                return 'No Image Available';
            })
            ->addColumn('destination_details', function ($row) {
                return nl2br(e($row->destination_details));
            })
            ->addColumn('status', function ($row) {
                return $row->STATUS ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('action', function ($row) {
                $editBtn = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                // $toggleBtn = $row->STATUS
                //     ? '<a href="javascript:void(0)" class="toggle-status btn btn-warning btn-sm" data-id="' . $row->ID . '" data-status="0">Disable</a>'
                //     : '<a href="javascript:void(0)" class="toggle-status btn btn-success btn-sm" data-id="' . $row->ID . '" data-status="1">Enable</a>';
                return $editBtn ;
            })
            ->rawColumns(['destination_image', 'destination_details', 'status', 'action'])
            ->make(true);
    }
}
