<?php

namespace App\Http\Controllers;

use App\Models\ActivitiesModel;
use App\Models\PackageMaster;
use App\Models\DestinationsModel;


use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class ActivitiesController extends Controller
{
    public function index()
    {
        return view('Activities.index');
    }

    

    public function getActivitiesData(Request $request)
    {
        if ($request->ajax()) {
            $data = ActivitiesModel::orderBy('id', 'desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('activity_image', function ($row) {
                    $imagesHtml = '';
                    if ($row->activity_image) {
                        foreach ($row->activity_image as $img) {
                            $imagesHtml .= '<img src="' . asset('storage/' . $img) . '" class="img-thumbnail" style="width:80px;margin-right:5px;">';
                        }
                    }
                    return $imagesHtml;
                })
                ->editColumn('status', function ($row) {
                    return $row->status === 'active'
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    // Prepare row data for edit
                    $rowData = base64_encode(json_encode([
                        'id'                => $row->id,
                        'activity_name'     => $row->activity_name,
                        'activity_details'  => $row->activity_details,
                        'meta_keyword'      => $row->meta_keyword,
                        'meta_title'        => $row->meta_title,
                        'meta_description'  => $row->meta_description,
                        'position'          => $row->position,
                        'status'            => $row->status,
                        'activity_image'    => json_encode($row->activity_image ?? []),
                    ]));

                    $toggleStatus = $row->status === 'active' ? 'inactive' : 'active';
                    $statusBtn = $row->status === 'active'
                        ? '<button class="btn btn-sm btn-warning toggle-status" data-id="' . $row->id . '" data-status="inactive">Disable</button>'
                        : '<button class="btn btn-sm btn-success toggle-status" data-id="' . $row->id . '" data-status="active">Enable</button>';

                    return '<button class="btn btn-sm btn-primary edit" data-row="' . $rowData . '">Edit</button> ' . $statusBtn;
                })
                ->rawColumns(['activity_image', 'status', 'action'])
                ->make(true);
        }
    }

    public function saveActivities(Request $request)
    {
        $id = $request->id ?? null;

        $data = [
            'activity_name'     => $request->activity_name,
            'activity_details'  => $request->activity_details,
            'meta_keyword'      => $request->meta_keyword,
            'meta_title'        => $request->meta_title,
            'meta_description'  => $request->meta_description,
            'position'          => $request->position,
            'status'            => $request->status,
        ];

        // Handle images
        if ($request->hasFile('activity_image')) {
            $images = [];
            foreach ($request->file('activity_image') as $file) {
                $images[] = $file->store('activities', 'public');
            }
            $data['activity_image'] = $images;
        } else if ($request->action == "update" && $id) {
            // Keep old images if no new images uploaded
            $existing = ActivitiesModel::find($id);
            if ($existing && $existing->activity_image) {
                $data['activity_image'] = $existing->activity_image;
            }
        }

        if ($request->action == "insert") {
            ActivitiesModel::create($data);
            return response()->json(['status' => true, 'message' => 'Activity added successfully']);
        } elseif ($request->action == "update" && $id) {
            $activity = ActivitiesModel::find($id);
            if (!$activity) {
                return response()->json(['status' => false, 'message' => 'Activity not found']);
            }
            $activity->update($data);
            return response()->json(['status' => true, 'message' => 'Activity updated successfully']);
        }

        return response()->json(['status' => false, 'message' => 'Invalid request']);
    }

    public function toggleStatus(Request $request)
    {
        $activity = ActivitiesModel::find($request->id);
        if (!$activity) {
            return response()->json(['status' => false, 'message' => 'Activity not found']);
        }

        // Update status from request
        if (in_array($request->status, ['active', 'inactive'])) {
            $activity->status = $request->status;
            $activity->save();
            return response()->json(['status' => true, 'message' => 'Status updated successfully']);
        }

        return response()->json(['status' => false, 'message' => 'Invalid status value']);
    }
}
