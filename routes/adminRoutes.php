<?php

use App\Models\PackageMaster;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\HomeFaqController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EnquiryFormController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\PackageMasterController;
use App\Http\Controllers\PackageCategoryController;
use App\Http\Controllers\WebSiteElementsController;
use App\Http\Controllers\HomeRecognitionsController;
use App\Http\Controllers\OurServicesModelController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ActivitiesController;


Route::get("login", [AdminController::class, "Login"])->name("login");
Route::post("AdminUserLogin", [AdminController::class, "AdminLoginUser"])->name("AdminLogin");
Route::get("getmenu-items", [HomePageController::class, "getMenu"]);
//pages

Route::middleware(['auth'])->group(function () {
    Route::get("/new-dashboard", [AdminController::class, "dashboard"])->name("new-dashboard");

    // Route::get("site-navigation",[AdminController::class,"siteNav"])->name("siteNav");
    // Route::post("addEditNavigation",[AdminController::class,"addEditNavigation"])->name("addNaviagtion");
    // Route::post("deleteNavigation",[AdminController::class,"deleteNavigation"])->name("deleteNavigation");
    // Route::post("navDataTable",[AdminController::class,"navDataTable"])->name("navDataTable");

    Route::get("manage-gallery", [AdminController::class, "manageGallery"])->name("manageGallery");
    Route::post("addGalleryItems", [AdminController::class, "addGalleryItems"])->name("addGalleryItems");
    Route::post("addGalleryDataTable", [AdminController::class, "addGalleryDataTable"])->name("addGalleryDataTable");

    Route::get("add-destinations", [DestinationController::class, "destinationMaster"])->name("DestinationsMaster");
    Route::post("save-destinations", [DestinationController::class, "saveDestinations"])->name("saveDestinations");
    Route::post("destinations-data", [DestinationController::class, "destinationsData"])->name("DestinationsData");
    Route::post("/destination/toggle-status", [DestinationController::class, "toggleStatus"])->name("toggleDestinationStatus");

    Route::prefix('activities')->group(function () {
        Route::get('/', [ActivitiesController::class, 'index'])->name('activities');
        Route::post('/data', [ActivitiesController::class, 'getActivitiesData'])->name('ActivitiesData');
        Route::post('/save', [ActivitiesController::class, 'saveActivities'])->name('saveActivities');
    });
    Route::post('/activities/toggle-status', [ActivitiesController::class, 'toggleStatus'])->name('toggleActivityStatus');


    Route::get("our-services-master", [OurServicesModelController::class, "viewOurServicesMaster"])->name("viewOurServicesMaster");
    Route::post("save-our-services", [OurServicesModelController::class, "saveOurServicesMaster"])->name("saveOurServicesMaster");
    Route::post("our-services-data", [OurServicesModelController::class, "ourServicesData"])->name("ourServicesData");
    Route::match(['get', 'post'], 'logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    //package Master

    Route::resource('packageMaster', PackageMasterController::class);
    Route::post("package-master-data-table", [PackageMasterController::class, "dataTable"])->name("packageMasterDataTable");
    Route::post("add-city", [PackageMasterController::class, "addCity"])->name("add-city");
    Route::post("enable-disable", [PackageMasterController::class, "enableDisablePackage"])->name("enableDisablePackage");

    //contactUsData
    Route::get("contact-us-admin-page", [ContactUsController::class, "contactUsAdminPage"])->name("contactUsData");
    Route::post("contact-us-data-table", [ContactUsController::class, "contactUsDataTable"])->name("contactUsDataTable");

    //enquiryData
    // Route::get("enquiry-admin-page", [EnquiryFormController::class, "enquiryAdminPage"])->name("enquiryAdminPage");
    // Route::post("enquiry-data-table", [EnquiryFormController::class, "enquiryDataTable"])->name("enquiryDataTable");

    Route::get("manage-package-categories", [PackageCategoryController::class, "managePackageCategories"])->name("managePackageCategories");
    Route::post("add-package-category-data", [PackageCategoryController::class, "addPackageCategoryData"])->name("addPackageCategoryData");
    Route::post("packageCategoryData", [PackageCategoryController::class, "packageCategoryData"])->name("packageCategoryData");

    //news letter

    Route::get("manage-news-letter-data", [NewsLetterController::class, "manageNewsLetterAdmin"])->name("manageNewsLetterData");
    Route::post("get-news-letter-data", [NewsLetterController::class, "getNewsLetterData"])->name("getNewsLetterData");

    Route::get('manageHomeFaq', [HomeFaqController::class, 'index'])->name('manageHomeFaq');
    Route::post('HomeFaqData', [HomeFaqController::class, 'GetAllData'])->name('homeFaq.data');
    Route::post('HomeFaqsmaster', [HomeFaqController::class, 'SaveMaster'])->name('homeFaq.save.master');
    Route::get('HomeFaqDataById', [HomeFaqController::class, 'dataById'])->name('homeFaqDataBy.id');
    Route::get('HomeFaqdelete', [HomeFaqController::class, 'delete'])->name('homeFaq.delete');

    Route::get("enquiry-admin-page", [EnquiryFormController::class, "enquiryAdminPage"])->name("enquiryAdminPage");
    Route::post("enquiry-data-table", [EnquiryFormController::class, "enquiryDataTable"])->name("enquiryDataTable");

    Route::get("add-web-site-elements", [WebSiteElementsController::class, "addWebSiteElements"])->name("webSiteElements");
    Route::post("save-web-site-element", [WebSiteElementsController::class, "saveWebSiteElement"])->name("saveWebSiteElement");
    Route::post("web-site-elements-data", [WebSiteElementsController::class, "getWebElementsData"])->name("webSiteElementsData");

    Route::get("slider-admin", [SliderController::class, "slider"])->name("Slider");
    Route::post("save-Slide", [SliderController::class, "saveSlide"])->name("saveSlide");
    Route::post("slider-data", [SliderController::class, "sliderData"])->name("sliderData");


    Route::get("blog-admin", [BlogController::class, "blogSlider"])->name("blogSlider");
    Route::post("save-blog", [BlogController::class, "saveBlog"])->name("saveBlog");
    Route::post("blog-data", [BlogController::class, "blogData"])->name("blogData");

    Route::get("home-recognitions-admin", [HomeRecognitionsController::class, "awardsSlider"])->name("awardsSlider");
    Route::post("home-recognitions-services", [HomeRecognitionsController::class, "awardsSaveSlide"])->name("awardsSaveSlide");
    Route::post("home-recognitions-data", [HomeRecognitionsController::class, "awardsData"])->name("awardsData");

    Route::get("testimonial-admin", [TestimonialController::class, "testimonialSlider"])->name("testimonialSlider");
    Route::post("testimonial-services", [TestimonialController::class, "testimonialSaveSlide"])->name("testimonialSaveSlide");
    Route::post("testimonial-data", [TestimonialController::class, "testimonialData"])->name("testimonialData");
});