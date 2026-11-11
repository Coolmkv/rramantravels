<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HomeFaqFormRequest;
use App\Models\HomeFaqModel;
use Exception;
use App\Traits\ResponseAPI;
use App\Traits\CommonFunctions;
use Yajra\DataTables\Facades\DataTables;

class HomeFaqController extends Controller
{
    use ResponseAPI;
    use CommonFunctions;

    public function index(){
        return view('Dashboard.Pages.Admin_home_faq_manage');
    }

    public function  GetAllData(){
        $query = HomeFaqModel::select('id','faq_question','faq_answer');
             return DataTables::of($query)
             ->addIndexColumn()
             ->addColumn('action',function($row){
                  $btn_edit = '<a data-row_id="'.$row->{'id'}.'"  href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                  $btn_delete = '<a  onclick="DeleteData('.$row->{'id'}.')" href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                 return $btn_edit.$btn_delete;
             })
             ->rawColumns(['action','name'])
             ->make(true);
     }

    public function SaveMaster(HomeFaqFormRequest $req){
        switch($req->input('action')){
           case 'insert':
            return $this->insert($req);
            break;
            case 'update':
            return $this->update($req);
            break;
            case 'delete':
                return $this->delete();
            break;
        }
    }


    public function insert(HomeFaqFormRequest $req){
       if($req->all()){
             $data = [
                 'faq_question'=>$req->input('faq_question'),
                 'faq_answer'=>$req->input('faq_answer'),
             ];
      $result  = HomeFaqModel::insert($data);
        if($result){
            return $this->returnMessage('Saved Successfully',true);
            }
       }
    }

    public function update(HomeFaqFormRequest $req){
        if($req->input('id')){
            $data=[
                'faq_question'=>$req->input('faq_question'),
                'faq_answer'=>$req->input('faq_answer'),
            ];
            $result= HomeFaqModel::where('id',$req->input('id'))->update($data);
            if($result){
                return $this->returnMessage('Update Succesfully',true);
            }
        }
    }

    public function dataById(Request $request){
        try{
       if($request->input('id')){
          $GetDataById = HomeFaqModel::find($request->input('id'));
          if($GetDataById){
           $return = $this->success("success",$GetDataById);
          }else{
            $return = $this->error("No data found.",200);
          }
       }else{
       $return = $this->error("Id is required",200);
       }
        }catch(Exception $exception){
          $this->reportException($exception);
            $return = $this->error("Something Went Wrong.",500);
        }
        return $return;
    }


    // DELETE DATA BY ID

    public function delete(Request $req){
        try{
         $findById = HomeFaqModel::find($req->input('id'));
          if($findById){
           $delete = $findById->delete();
           if($delete){
            return $this->success("Delete Successfully",true);
           }else{
            return $this->error("Something went wrong",500);
           }
          }
        }catch(Exception $exception){
          $this->reportException($exception);
         return $this->error("Something went wrong");
        }


     }



    }


