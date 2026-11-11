<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\CityMaster;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PackageMaster;
use App\Models\ActivitiesModel;
use App\Models\DestinationsModel;


use App\Traits\CommonFunctions;
use App\Models\PackageItinerary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PackageMasterController extends Controller
{
    const ACTIVE_PACKAGES = "getActivePackages";
    use CommonFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $package_types = PackageMaster::PACKAGE_TYPES;
            $city_master = CityMaster::where(CityMaster::STATUS, 1)->get([CityMaster::CITY_NAME, CityMaster::ID]);
            $allDestinations = DestinationsModel::pluck('destination_name')->toArray();
$allActivities = ActivitiesModel::pluck('activity_name')->toArray();
            return view("Dashboard.PackageMaster.viewPackages", compact("package_types", "city_master",'allDestinations','allActivities'));
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


   public function store(FormRequest $request)
{
    try { 
        $validate = $this->validatePackageData($request);
        if ($validate->fails()) {
            return response()->json([
                "status" => false, 
                "message" => $validate->getMessageBag()->first(), 
                "data" => null
            ]);
        }

        DB::beginTransaction();

        // Determine if this is a new or existing package
        $packageId = $request->input(PackageMaster::ID);
        $newPackage = $packageId ? PackageMaster::find($packageId) : new PackageMaster();

        if ($packageId && !$newPackage) {
            DB::rollBack();
            return response()->json([
                "status" => false,
                "message" => "Package not found.",
                "data" => null
            ]);
        }

        // Handle image upload
        $images = [];
        if ($request->hasFile(PackageMaster::PACKAGE_IMAGE)) {
            $images = $this->uploadMultipleImages($request, PackageMaster::PACKAGE_IMAGE);
            $newPackage->{PackageMaster::PACKAGE_IMAGE} = $images;
        }

        // Save package basic details
        $newPackage->{PackageMaster::PACKAGE_NAME} = $request->input(PackageMaster::PACKAGE_NAME);
        $newPackage->{PackageMaster::PACKAGE_COUNTRY} = $request->input(PackageMaster::PACKAGE_COUNTRY);
        $newPackage->{PackageMaster::PACKAGE_DURATION_DAYS} = $request->input(PackageMaster::PACKAGE_DURATION_DAYS);
        $newPackage->{PackageMaster::PACKAGE_DURATION_NIGHTS} = $request->input(PackageMaster::PACKAGE_DURATION_NIGHTS);
        $newPackage->{PackageMaster::PACKAGE_OFFER_PRICE} = $request->input(PackageMaster::PACKAGE_OFFER_PRICE);
        $newPackage->{PackageMaster::PACKAGE_PRICE} = $request->input(PackageMaster::PACKAGE_PRICE);
        $newPackage->{PackageMaster::PACKAGE_TYPE} = $request->input(PackageMaster::PACKAGE_TYPE);
        $newPackage->{PackageMaster::PACKAGE_EXTERNAL_LINK} = $request->input(PackageMaster::PACKAGE_EXTERNAL_LINK);
        $newPackage->{PackageMaster::DESCRIPTION} = $request->input(PackageMaster::DESCRIPTION);
        $newPackage->{PackageMaster::PACKAGE_INCLUDED} = $request->input(PackageMaster::PACKAGE_INCLUDED);
        $newPackage->{PackageMaster::PACKAGE_EXCLUDED} = $request->input(PackageMaster::PACKAGE_EXCLUDED);
        $newPackage->{PackageMaster::ITINERARY_TITLES} = $request->input(PackageMaster::ITINERARY_TITLES);
        $newPackage->{PackageMaster::ITINERARY_DESCRIPTIONS} = $request->input(PackageMaster::ITINERARY_DESCRIPTIONS);
        $newPackage->{PackageMaster::META_TITLE} = $request->input(PackageMaster::META_TITLE);
        $newPackage->{PackageMaster::META_KEYWORD} = $request->input(PackageMaster::META_KEYWORD);
        $newPackage->{PackageMaster::META_DESCRIPTION} = $request->input(PackageMaster::META_DESCRIPTION);

        // Save destinations and activities as JSON
        $newPackage->{PackageMaster::DESTINATIONS} = $request->input('destinations') 
            ? json_encode($request->input('destinations')) 
            : null;
        $newPackage->{PackageMaster::ACTIVITIES} = $request->input('activities') 
            ? json_encode($request->input('activities')) 
            : null;

        $newPackage->{PackageMaster::STATUS} = 1;
        $newPackage->{PackageMaster::UPDATED_BY} = $request->input(PackageMaster::ID) ? Auth::user()->id : null;
        $newPackage->{PackageMaster::CREATED_BY} = $request->input(PackageMaster::ID) ? null : Auth::user()->id;

        $newPackage->save();

        // Save city details for the package
        $this->saveUpdatePackageItinerary($request, $newPackage->id);

        Cache::forget(self::ACTIVE_PACKAGES);
        DB::commit();

        return response()->json([
            "status" => true, 
            "message" => "Package details saved successfully."
        ]);
    } catch (Exception $exception) {
        DB::rollBack();
        report($exception);
        return response()->json([
            "status" => false, 
            "message" => $exception->getMessage()
        ]);
    }
}




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

  public function edit($id)
{
    $packageData = PackageMaster::where([
        [PackageMaster::ID, $id],
        [PackageMaster::STATUS, 1]
    ])->with("itinerary", "itinerary.city")->first();

    if (!$packageData) {
        abort(404, "Package not found.");
    }

    $package_types = PackageMaster::PACKAGE_TYPES;
    $city_master = CityMaster::where(CityMaster::STATUS, 1)->get([CityMaster::CITY_NAME, CityMaster::ID]);

    // Fetch all available destinations and activities
    $allDestinations = DestinationsModel::pluck('destination_name')->toArray();
    $allActivities = ActivitiesModel::pluck('activity_name')->toArray();

    // Pass existing selected destinations & activities
    $selectedDestinations = $packageData->destinations ?? [];
    $selectedActivities = $packageData->activities ?? [];

    return view("Dashboard.PackageMaster.editPackage", compact(
        "package_types", 
        "city_master", 
        "packageData",
        "allDestinations",
        "allActivities",
        "selectedDestinations",
        "selectedActivities"
    ));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
    public function validatePackageData(Request $request)
    {
        return Validator::make($request->all(), [
            "id" => "nullable|bail|required_if:action,edit",
            "package_name" => "required|bail|unique:package_master,package_name," . $request->id . ",id",
            "package_type" => "required|bail|in:" . implode(",", PackageMaster::PACKAGE_TYPES),
            "package_price" => "required|integer|gt:" . $request->package_offer_price,
            "package_offer_price" => "required|integer|lt:" . $request->package_price . "|gt:0",
            "package_duration_days" => "required|integer|gte:0",
            "package_country" => "required|bail",
            "package_duration_nights" => "required|integer|gte:0",
            "package_external_link" => "nullable|url",
            "package_image.*" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            'description' => 'nullable|string|max:65535',
            "package_included" => "nullable|array",
            "package_excluded" => "nullable|array",
            "itinerary_titles" => "nullable|array",
            "itinerary_descriptions" => "nullable|array",
            "meta_title" => "bail|nullable",
            "meta_keyword" => "bail|nullable",
            "meta_description" => "bail|nullable",
            "days" => "nullable|array",
            "days.*" => "numeric",
            "city_id.*" => "nullable|array",
            "city_id.*" => "exists:" . CityMaster::TABLE_NAME . "," . CityMaster::ID,
        ]);
    }

    // public function updloadImage(FormRequest $request)
    // {

    //     $maxId = PackageMaster::max(PackageMaster::ID);
    //     $maxId += 1;
    //     $timeNow = strtotime($this->timeNow());
    //     $maxId .= "_$timeNow";
    //     return $this->uploadLocalFile($request, PackageMaster::PACKAGE_IMAGE, "/website/uploads/package_images/", "package_$maxId");
    // }

    public function uploadMultipleImages(FormRequest $request, $fieldName)
    {
        $images = [];
        if ($request->hasFile($fieldName)) {
            foreach ($request->file($fieldName) as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('website/uploads/package_images', $filename, 'public');
                $images[] = $path;
            }
        }
        return $images;
    }

    public function dataTable()
    {
        try {
            $query = PackageMaster::select(
                'id',
                'package_name',
                'package_image',
                'package_type',
                'package_country',
                'status',
                'package_price',
                'package_offer_price',
                'package_duration_days',
                'package_duration_nights',
                'package_external_link',
                'description',
                'package_included',
                'package_excluded',
                'itinerary_titles',
                'itinerary_descriptions',
                'meta_title',
                'meta_keyword',
                'meta_description'
            );

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('package_image', function ($row) {
                    $images = is_string($row->package_image)
                        ? json_decode($row->package_image, true)
                        : $row->package_image;

                    if (is_array($images) && !empty($images)) {
                        $html = '';
                        foreach ($images as $image) {
                            $html .= '<img alt="Image" src="' . asset('storage/' . $image) . '" class="img-thumbnail" style="max-width: 100px;"> ';
                        }
                        return $html;
                    }
                    return 'No Images Available';
                })
                ->addColumn('package_included', function ($row) {
                    $included = is_string($row->package_included)
                        ? json_decode($row->package_included, true)
                        : $row->package_included;

                    return is_array($included) ? implode(', ', $included) : 'N/A';
                })
                ->addColumn('package_excluded', function ($row) {
                    $excluded = is_string($row->package_excluded)
                        ? json_decode($row->package_excluded, true)
                        : $row->package_excluded;

                    return is_array($excluded) ? implode(', ', $excluded) : 'N/A';
                })
                ->addColumn('itinerary_titles', function ($row) {
                    $titles = is_string($row->itinerary_titles)
                        ? json_decode($row->itinerary_titles, true)
                        : $row->itinerary_titles;

                    return is_array($titles) ? implode('<br>', $titles) : 'N/A';
                })
                ->addColumn('itinerary_descriptions', function ($row) {
                    $descriptions = is_string($row->itinerary_descriptions)
                        ? json_decode($row->itinerary_descriptions, true)
                        : $row->itinerary_descriptions;

                    return is_array($descriptions) ? implode('<br>', $descriptions) : 'N/A';
                })
                ->addColumn('description', function ($row) {
                    return nl2br(e($row->description));
                })
                ->addColumn('package_external_link', function ($row) {
                    return '<a href="' . e($row->package_external_link) . '" target="_blank" class="btn btn-info">Link</a>';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route("packageMaster.edit", $row->id);
                    $btnEdit = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>';
                    $btnToggle = $row->status == 1
                        ? '<a href="javascript:void(0)" onclick="Disable(' . $row->id . ')" class="btn btn-danger btn-sm">Disable</a>'
                        : '<a href="javascript:void(0)" onclick="Enable(' . $row->id . ')" class="btn btn-success btn-sm">Enable</a>';

                    return $btnEdit . ' ' . $btnToggle;
                })
                ->addColumn('description', function ($row) {
                    $modalId = "modal-description-{$row->id}";
                    $shortDescription = Str::limit(strip_tags($row->description), 50, '...');
                    $fullDescription = nl2br(e($row->description));
                
                    return '
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">
                            View Description
                        </button>
                        <div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="' . $modalId . '-label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="' . $modalId . '-label">Package Description</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ' . $fullDescription . '
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                })  
                ->addColumn('itinerary_titles', function ($row) {
                    $modalId = "modal-itinerary-titles-{$row->id}";
                    $shortTitles = Str::limit(strip_tags(implode(', ', $row->itinerary_titles)), 50, '...');
                    $fullTitles = nl2br(e(implode('<br>', $row->itinerary_titles)));
                
                    return '
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">
                            View Iternary Titles
                        </button>
                        <div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="' . $modalId . '-label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="' . $modalId . '-label">Itinerary Titles</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ' . $fullTitles . '
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('itinerary_descriptions', function ($row) {
                    $modalId = "modal-itinerary-descriptions-{$row->id}";
                    $shortDescriptions = Str::limit(strip_tags(implode(', ', $row->itinerary_descriptions)), 50, '...');
                    $fullDescriptions = nl2br(e(implode('<br>', $row->itinerary_descriptions)));
                
                    return '
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">
                            View Iternary Descriptions
                        </button>
                        <div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="' . $modalId . '-label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="' . $modalId . '-label">Itinerary Descriptions</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ' . $fullDescriptions . '
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                })              
                ->rawColumns(['package_image', 'description', 'itinerary_titles', 'itinerary_descriptions', 'package_external_link', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function addCity(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "city_name" => "required|string|max:255"
            ]);
            if ($validate->fails()) {
                $return = ["status" => false, "message" => $validate->getMessageBag()->first(), "data" => null];
            } else {
                $check = CityMaster::where(CityMaster::CITY_NAME, $request->{CityMaster::CITY_NAME})->first();

                if (empty($check)) {
                    $city = new CityMaster();
                    $city->{CityMaster::CITY_NAME} = $request->{CityMaster::CITY_NAME};
                    $city->{CityMaster::STATUS} = 1;
                    $city->{CityMaster::CREATED_BY} = Auth::user()->id;
                    $city->save();
                    $return = ["status" => true, "message" => "Saved successfully", "data" => CityMaster::where(CityMaster::STATUS, 1)->get([CityMaster::CITY_NAME, CityMaster::ID])];
                } else {
                    $return = ["status" => false, "message" => "City name duplicate", "data" => null];
                }
            }

        } catch (Exception $exception) {
            report($exception);
            $return = ["status" => false, "message" => "Exception occurred", "data" => null];
        }
        return response()->json($return);
    }

    public function validateDuration(FormRequest $request)
    {
        $return = ["status" => true, "message" => "Success."];
        $days = $request->days;
        if (count($days)) {
            $total_Days = 0;
            foreach ($days as $d) {
                $total_Days += $d;
            }
            if ($total_Days > $request->package_duration_days) {
                $return = ["status" => false, "message" => "Total Package duration days is less than itinerary days."];
            }
        }
        return $return;
    }
    public function saveUpdatePackageItinerary(FormRequest $request, $id)
    {
        $days = $request->days;
        $city_ids = $request->city_id;
        if (count($days)) {
            PackageItinerary::where(PackageItinerary::PACKAGE_MASTER_ID, $id)
                ->update([PackageItinerary::STATUS => 0, PackageItinerary::UPDATED_BY => Auth::user()->id]);

            $check = PackageItinerary::where(PackageItinerary::PACKAGE_MASTER_ID, $id)->get();
            $insertData = [];

            foreach ($days as $key => $val) {
                if (!empty($check)) {
                    $checkItem = $check->where(PackageItinerary::CITY_ID, $city_ids[$key])->first();
                    if ($checkItem) {
                        PackageItinerary::where(PackageItinerary::ID, $checkItem->id)->update([
                            PackageItinerary::STATUS => 1,
                            PackageItinerary::UPDATED_BY => Auth::user()->id,
                            PackageItinerary::DAYS => $val
                        ]);
                    } else {
                        $insertData[] = [
                            PackageItinerary::STATUS => 1,
                            PackageItinerary::CREATED_BY => Auth::user()->id,
                            PackageItinerary::DAYS => $val,
                            PackageItinerary::PACKAGE_MASTER_ID => $id,
                            PackageItinerary::CITY_ID => $city_ids[$key]
                        ];
                    }
                } else {
                    $insertData[] = [
                        PackageItinerary::STATUS => 1,
                        PackageItinerary::CREATED_BY => Auth::user()->id,
                        PackageItinerary::DAYS => $val,
                        PackageItinerary::PACKAGE_MASTER_ID => $id,
                        PackageItinerary::CITY_ID => $city_ids[$key]
                    ];
                }
            }

            if (count($insertData)) {
                PackageItinerary::insert($insertData);
            }
        }
    }

    public function getActivePackages()
    {
        $packageData = "";//Cache::get(self::ACTIVE_PACKAGES,null);
        if (empty($packageData)) {
            $packages = PackageMaster::where(PackageMaster::STATUS, 1)
                ->with(["itinerary", "itinerary.city"])->get();
            if (count($packages)) {
                $packageData = collect($packages)->groupBy(PackageMaster::PACKAGE_TYPE);

                Cache::rememberForever(self::ACTIVE_PACKAGES, function () use ($packageData) {
                    return $packageData;
                });
            }
        }
        return $packageData;

    }
    public function enableDisablePackage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "action" => "required|in:enable,disable",
            "id" => "required"
        ]);
        if ($validator->fails()) {
            return $this->returnMessage($validator->getMessageBag()->first());
        }
        $check = PackageMaster::where(PackageMaster::ID, $request->input(PackageMaster::ID))->first();
        if ($check) {
            if ($request->action == "disable") {
                $check->{PackageMaster::STATUS} = 0;
                $check->{PackageMaster::UPDATED_BY} = Auth::user()->id;
                $check->save();
                Cache::forget(self::ACTIVE_PACKAGES);
                $return = $this->returnMessage("Disabled successfully.", true);
            } elseif ($request->action == "enable") {
                $check->{PackageMaster::STATUS} = 1;
                $check->{PackageMaster::UPDATED_BY} = Auth::user()->id;
                $check->save();
                Cache::forget(self::ACTIVE_PACKAGES);
                $return = $this->returnMessage("Enabled successfully.", true);
            } else {
                $return = $this->returnMessage("Undefined action.");
            }

        } else {
            $return = $this->returnMessage("Details not found.");
        }
        return $return;
    }
}
