<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeRecognitionsRequest;
use App\Models\HomeRecognitionsModel;
use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class HomeRecognitionsController extends Controller
{
    use CommonFunctions;
    //

    public function awardsSlider(){
        return view("Dashboard.Pages.homeRecognitions");
    }

    public function awardsData(){
        $query = HomeRecognitionsModel::select(HomeRecognitionsModel::IMAGE,
        HomeRecognitionsModel::ID,
        // HomeRecognitionsModel::HEADING_TOP,
        // HomeRecognitionsModel::HEADING_BOTTOM,
        // HomeRecognitionsModel::HEADING_MIDDLE,
        HomeRecognitionsModel::SLIDE_SORTING,
        HomeRecognitionsModel::SLIDE_STATUS);
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row){
                $btn_edit = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                
                $btn_disable = ' <a   href="javascript:void(0)" onclick="Disable('.$row->{HomeRecognitionsModel::ID}.')" class="btn btn-danger btn-sm">Disable Slide</a>';
                $btn_enable = ' <a   href="javascript:void(0)" onclick="Enable('.$row->{HomeRecognitionsModel::ID}.')" class="btn btn-primary btn-sm">Enable Slide</a>';
                if($row->{HomeRecognitionsModel::SLIDE_STATUS}==HomeRecognitionsModel::SLIDE_STATUS_DISABLED){
                    return $btn_edit.$btn_enable;
                }else{
                    return $btn_edit.$btn_disable;
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function awardsSaveSlide(HomeRecognitionsRequest $request){
        try{
            switch($request->input("action")){
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
                $return = ["status"=>false,"message"=>"Unknown case","data"=>""];
            }
        }catch(Exception $exception){
            $return = $this->reportException($exception);
        }
        return response()->json($return);
    }

    public function insertSlide(HomeRecognitionsRequest $request){
        $imageUpload = $this->slideImageUpload($request);
        if($imageUpload["status"]){
            $HomeRecognitionsModel = new HomeRecognitionsModel();
            $HomeRecognitionsModel->{HomeRecognitionsModel::IMAGE} = $imageUpload["data"];
            // $HomeRecognitionsModel->{HomeRecognitionsModel::HEADING_TOP} = $request->input(HomeRecognitionsModel::HEADING_TOP);
            // $HomeRecognitionsModel->{HomeRecognitionsModel::HEADING_MIDDLE} = $request->input(HomeRecognitionsModel::HEADING_MIDDLE);
            // $HomeRecognitionsModel->{HomeRecognitionsModel::HEADING_BOTTOM} = $request->input(HomeRecognitionsModel::HEADING_BOTTOM);
            $HomeRecognitionsModel->{HomeRecognitionsModel::SLIDE_STATUS} = $request->input(HomeRecognitionsModel::SLIDE_STATUS);
            $HomeRecognitionsModel->{HomeRecognitionsModel::SLIDE_SORTING} = $request->input(HomeRecognitionsModel::SLIDE_SORTING);           
            $HomeRecognitionsModel->{HomeRecognitionsModel::STATUS} = 1;
            $HomeRecognitionsModel->{HomeRecognitionsModel::CREATED_BY} = Auth::user()->id;
            $HomeRecognitionsModel->save();
            $return = ["status"=>true,"message"=>"Saved successfully","data"=>null];
            $this->forgetSlides();
        }else{
            $return = $imageUpload;
        }
        return $return;
    }

    public function slideImageUpload(HomeRecognitionsRequest $request){
        $maxId = HomeRecognitionsModel::max(HomeRecognitionsModel::ID);
        $maxId += 1;
        $timeNow = strtotime($this->timeNow());
        $maxId .= "_$timeNow";
        return $this->uploadLocalFile($request,"image","/website/uploads/Slider/","slide_$maxId");
    }

    // public function updateSlide(HomeRecognitionsRequest $request){
    //     $check = HomeRecognitionsModel::where([HomeRecognitionsModel::ID=>$request->input(HomeRecognitionsModel::ID),HomeRecognitionsModel::STATUS=>1])->first();
    //     if($check){
    //         if($request->input(HomeRecognitionsModel::IMAGE)){
    //             $imageUpload =$this->slideImageUpload($request);
    //             if($imageUpload["status"]){
    //                 $check->{HomeRecognitionsModel::IMAGE} = $imageUpload["data"];
    //                 $check->{HomeRecognitionsModel::SLIDE_SORTING} = $request->input(HomeRecognitionsModel::SLIDE_SORTING);
    //                 $check->{HomeRecognitionsModel::SLIDE_STATUS} = $request->input(HomeRecognitionsModel::SLIDE_STATUS);
    //                 $check->{HomeRecognitionsModel::UPDATED_BY} = Auth::user()->id;
    //                 $check->save();
    //                 $this->forgetSlides();
    //                 $return = ["status"=>true,"message"=>"Updated successfully","data"=>null];
    //             }else{
    //                 $return = $imageUpload;
    //             }
    //         }else{
    //             $check->{HomeRecognitionsModel::SLIDE_SORTING} = $request->input(HomeRecognitionsModel::SLIDE_SORTING);
    //             $check->{HomeRecognitionsModel::SLIDE_STATUS} = $request->input(HomeRecognitionsModel::SLIDE_STATUS);
    //             $check->{HomeRecognitionsModel::UPDATED_BY} = Auth::user()->id;
    //             $check->save();
    //             $this->forgetSlides();
    //             $return = ["status"=>true,"message"=>"Updated successfully","data"=>null];            
    //         }
    //     }else{
    //         $return = ["status"=>false,"message"=>"Details not found.","data"=>null];
    //     }
    //     return $return;
    // }

    public function updateSlide(HomeRecognitionsRequest $request)
{
    // Find the record based on ID and status
    $check = HomeRecognitionsModel::where([
        HomeRecognitionsModel::ID => $request->input(HomeRecognitionsModel::ID),
        HomeRecognitionsModel::STATUS => 1
    ])->first();

    if ($check) {
        // If a new image is provided, upload and update the image
        if ($request->hasFile('image')) {
            $imageUpload = $this->slideImageUpload($request);
            if ($imageUpload["status"]) {
                $check->{HomeRecognitionsModel::IMAGE} = $imageUpload["data"];
            } else {
                return $imageUpload; // Return error if image upload fails
            }
        }

        // Update other fields
        $check->{HomeRecognitionsModel::SLIDE_SORTING} = $request->input(HomeRecognitionsModel::SLIDE_SORTING);
        $check->{HomeRecognitionsModel::SLIDE_STATUS} = $request->input(HomeRecognitionsModel::SLIDE_STATUS);
        $check->{HomeRecognitionsModel::UPDATED_BY} = Auth::user()->id;

        $check->save(); // Save the updated record
        $this->forgetSlides(); // Clear cache or reload necessary data

        return ["status" => true, "message" => "Updated successfully", "data" => null];
    } else {
        return ["status" => false, "message" => "Details not found.", "data" => null];
    }
}


    // public function enableDisableSlide(HomeRecognitionsRequest $request){
    //     $check = HomeRecognitionsModel::find($request->input(HomeRecognitionsModel::ID));
    //     if($check){
    //         $check->{HomeRecognitionsModel::UPDATED_BY} = Auth::user()->id;
    //         if($request->input("action")=="enable"){
    //             $check->{HomeRecognitionsModel::SLIDE_STATUS} = HomeRecognitionsModel::SLIDE_STATUS_LIVE;
    //             $return = ["status"=>true,"message"=>"Enabled successfully.","data"=>""];
    //         }else{
    //             $check->{HomeRecognitionsModel::SLIDE_STATUS} = HomeRecognitionsModel::SLIDE_STATUS_DISABLED;
    //             $return = ["status"=>true,"message"=>"Disabled successfully.","data"=>""];
    //         }
    //         $this->forgetSlides();
    //         $check->save();
    //     }else{
    //         $return = ["status"=>false,"message"=>"Details not found.","data"=>""];
    //     }
    //     return $return;
    // }
    public function enableDisableSlide(HomeRecognitionsRequest $request) {
        $check = HomeRecognitionsModel::find($request->input(HomeRecognitionsModel::ID));
        
        if ($check) {
            $check->{HomeRecognitionsModel::UPDATED_BY} = Auth::user()->id;
            
            if ($request->input("action") == "enable") {
                $check->{HomeRecognitionsModel::SLIDE_STATUS} = HomeRecognitionsModel::SLIDE_STATUS_LIVE;
                $return = ["status" => 1, "message" => "Enabled successfully.", "data" => ""];
            } else {
                $check->{HomeRecognitionsModel::SLIDE_STATUS} = HomeRecognitionsModel::SLIDE_STATUS_DISABLED;
                $return = ["status" => 1, "message" => "Disabled successfully.", "data" => ""];
            }
            
            $this->forgetSlides();
            $check->save();
        } else {
            $return = ["status" => 0, "message" => "Details not found.", "data" => ""];
        }
        
        return $return;
    }
    
}
