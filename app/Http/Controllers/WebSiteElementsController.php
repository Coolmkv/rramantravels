<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebSiteElementRequest;
use App\Models\WebSiteElements;
use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class WebSiteElementsController extends Controller
{
    
    use CommonFunctions;
    const ELEMENTS = [
    "Logo",
    "Address",
    "Email",
    "Phone_number1",
    "Phone_number2",
    "Phone_number3",
    "Phone_number4",
    "Phone_number5",
    "ContactUs_heading",
    "contactus_content",
    "Map_link",
    "contactus_image1",
    "contactus_image2",
    "contactus_image3",
    "facebook_link",
    "youtube_link",
    "pinterest_link", // ✅ Pinterest link added
    "linkedin_link",  // ✅ LinkedIn link added
    "insta_link",
    "whatsapp_footer_link",
    "phone_footer_link",
    "footer_content",
    "our_services_subheading",
    "home_other_services_content_heading",
    "home_other_services_image",
    "home_other_services_content_subheading",
    "home_other_services_happy_customer_no",
    "home_other_services_holidays_content",
    "home_other_services_weddings_content",
    "home_other_services_event_content",
    "home_other_services_friendly_support_content",
    "years_of_experience",
    "home_aboutus_content",
    "home_aboutus_content_image",
    "home_aboutus_content_popular_destination_no",
    "home_aboutus_content_satisfied_clients_no",
    "about_company_heading",
    "about_company_subheading",
    "about_us_image_1",
    "about_us_image_2",
    "about_us_image_3",
    "about_us_image_4",
    "about_us_image_3_heading",
    "about_us_image_3_subheading",
    "about_us_image_2_card_1_heading",
    "about_us_image_2_card_1_subheading",
    "about_us_image_2_card_2_heading",
    "about_us_image_2_card_2_subheading",
    "about_testimonial_no",
    "about_testimonial_heading",
];
    public function addWebSiteElements()
    {
        $titles = self::ELEMENTS;
        return view("Dashboard.Pages.webSiteElements", compact("titles"));
    }

    public function saveWebSiteElement(WebSiteElementRequest $request)
    {
        try {
            $requestData = $request->all();
            if ($requestData["action"] == "insert") {
                $return = $this->insertWebSiteElement($requestData, $request);
            } else if ($request["action"] == "update") {
                $return = $this->updateWebSiteElement($requestData, $request);
            } else if ($request["action"] == "disable") {
                $check = WebSiteElements::where(WebSiteElements::ID, $requestData[WebSiteElements::ID])->first();
                $check->{WebSiteElements::UPDATED_BY} = Auth::user()->id;
                $check->{WebSiteElements::STATUS} = 0;
                $check->save();
                $this->forgetWebSiteElements();
                $return = ["status" => true, "message" => "Details updated", "data" => null];
            } else if ($request["action"] == "enable") {
                $check = WebSiteElements::where(WebSiteElements::ID, $requestData[WebSiteElements::ID])->first();
                $check->{WebSiteElements::UPDATED_BY} = Auth::user()->id;
                $check->{WebSiteElements::STATUS} = 1;
                $check->save();
                $this->forgetWebSiteElements();
                $return = ["status" => true, "message" => "Details updated", "data" => null];
            } else {
                $return = ["status" => false, "message" => "Invalid action", "data" => null];
            }
        } catch (Exception $exception) {
            $return = ["status" => false, "message" => "Exception occurred  : " . $exception->getMessage(), "data" => null];
        }
        return response()->json($return);
    }

    public function updateWebSiteElement($requestData, WebSiteElementRequest $request)
    {
        $check = WebSiteElements::where(WebSiteElements::ID, $requestData[WebSiteElements::ID])->first();
        if ($check) {
            if ($this->checkDuplicateElement($requestData[WebSiteElements::ELEMENT], $requestData[WebSiteElements::ID])) {
                $return = ["status" => false, "message" => "Element already found", "data" => null];
            } else {
                $check->{WebSiteElements::ELEMENT} = $requestData[WebSiteElements::ELEMENT];
                $check->{WebSiteElements::ELEMENT_TYPE} = $requestData[WebSiteElements::ELEMENT_TYPE];
                if ($requestData[WebSiteElements::ELEMENT_TYPE] == "Image") {
                    $fileUpload = $this->uploadLocalFile($request, "element_details_image", "/website/uploads/WesiteElements/");
                    if ($fileUpload["status"]) {
                        $check->{WebSiteElements::ELEMENT_DETAILS} = $fileUpload["data"];
                    } else {
                        return $fileUpload;
                    }
                } else {
                    $check->{WebSiteElements::ELEMENT_DETAILS} = $requestData["element_details_text"];
                }
                $check->save();
                $this->forgetWebSiteElements();
                $return = ["status" => true, "message" => "Details updated", "data" => null];
            }
        } else {
            $return = ["status" => false, "message" => "Details not found", "data" => null];
        }
        return $return;
    }

    public function checkDuplicateElement($element, $existingId = null)
    {
        $check = WebSiteElements::where(WebSiteElements::ELEMENT, $element);
        if ($existingId) {
            $check->where(WebSiteElements::ID, "!=", $existingId);
        }
        return $check->exists();
    }
    public function insertWebSiteElement($requestData, WebSiteElementRequest $request)
    {
        $check = WebSiteElements::where([
            [WebSiteElements::ELEMENT, $requestData[WebSiteElements::ELEMENT]],
            [WebSiteElements::ELEMENT_TYPE, $requestData[WebSiteElements::ELEMENT_TYPE]]
        ])->first();
        if ($this->checkDuplicateElement($requestData[WebSiteElements::ELEMENT])) {
            $return = ["status" => false, "message" => "Element already found", "data" => null];
        } else {
            $check = new WebSiteElements();
            $check->{WebSiteElements::ELEMENT} = $requestData[WebSiteElements::ELEMENT];
            $check->{WebSiteElements::ELEMENT_TYPE} = $requestData[WebSiteElements::ELEMENT_TYPE];
            if ($requestData[WebSiteElements::ELEMENT_TYPE] == "Image") {
                $fileUpload = $this->uploadLocalFile($request, "element_details_image", "/website/uploads/WesiteElements/");
                if ($fileUpload["status"]) {
                    $check->{WebSiteElements::ELEMENT_DETAILS} = $fileUpload["data"];
                } else {
                    return $fileUpload;
                }
            } else {
                $check->{WebSiteElements::ELEMENT_DETAILS} = $requestData["element_details_text"];
            }
            $this->forgetWebSiteElements();
            $check->save();
            $return = ["status" => true, "message" => "Saved successfully.", "data" => null];
        }
        return $return;
    }


    public function getWebElementsData()
    {
        $data = WebSiteElements::select(
            WebSiteElements::ID,
            WebSiteElements::ELEMENT,
            WebSiteElements::ELEMENT_TYPE,
            WebSiteElements::ELEMENT_DETAILS,
            WebSiteElements::STATUS
        );

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                if ($row->{WebSiteElements::STATUS} == 1) {
                    $btn .= '<a href="javascript:void(0)" onclick="Disable(\''.$row->{WebSiteElements::ID}.'\')" class="btn btn-danger btn-sm">Disable</a>';
                } else {
                    $btn .= '<a href="javascript:void(0)" onclick="Enable(\''.$row->{WebSiteElements::ID}.'\')" class="btn btn-info btn-sm">Enable</a>';
                }
                return $btn;
            })
            ->rawColumns(['action',WebSiteElements::ELEMENT_DETAILS])
            ->make(true);
    }
}
