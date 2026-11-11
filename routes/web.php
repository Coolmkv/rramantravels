<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EnquiryFormController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\OurServicesModelController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\QueryController;

use Illuminate\Support\Facades\Auth;
//use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get("/",[HomePageController::class,"homePage"]);


Route::get("comingsoon",[HomePageController::class,"ComingSoon"])->name("ComingSoon");
Route::get("about-us",[HomePageController::class,"aboutUs"])->name("aboutUs");
Route::get("terms-conditions",[HomePageController::class,"termsConditions"])->name("termsConditions");
Route::get("shipping-delivery-policy",[HomePageController::class,"shippingDeliverypolicy"])->name("shippingDeliverypolicy");
Route::get("conditions-and-refund-policy",[HomePageController::class,"CancellationRefundPolicy"])->name("CancellationRefundPolicy");
Route::get("privacy-policy",[HomePageController::class,"privacyPolicy"])->name("privacyPolicy");
Route::get("our-service",[HomePageController::class,"ourServices"])->name("destinations");
Route::get("destinations",[HomePageController::class,"event"])->name("event");
Route::get("gallery",[HomePageController::class,"galleryPages"])->name("galleryPages");
Route::get("contact-us",[HomePageController::class,"contactUs"])->name("contactUs");
// Route::get("get-home-page-destinations",[DestinationController::class,"getHomePageDestinations"])->name("getHomePageDestinations");
Route::get("get-home-page-services",[OurServicesModelController::class,"getHomePageServices"])->name("getHomePageServices");
Route::post("contact-us-form",[ContactUsController::class,"saveContactUsDetails"])->name("saveContactUsDetails");
Route::get('refresh-captcha',[HomePageController::class,"refreshCapthca"])->name("refreshCaptcha");
Route::post('subscribe-news-letter',[NewsLetterController::class,"subscribeNewsLetter"])->name("subscribeNewsLetter");
// Route::get("service-page",[HomePageController::class,"ourServicesPage"])->name("ourServicesPage");

Route::get("service-page",[HomePageController::class,"servicePages"])->name("servicePages");

Route::get("tours",[HomePageController::class,"tourpage"])->name("tourpage");
Route::get("tour/{slug}",[HomePageController::class,"tourDetailpage"])->name("tourDetailpage");
Route::match(['get', 'post'], '/filter-packages', [HomePageController::class, 'filterPackages'])->name('filterPackages');
Route::get("destinations",[HomePageController::class,"destinationpage"])->name("destinationpage");
Route::get("destination/{destination_slug}",[HomePageController::class,"destinationDetailpage"])->name("destinationDetailpage");

Route::get("blogs",[HomePageController::class,"blogpage"])->name("blogpage");
Route::get("blog/{slug}",[HomePageController::class,"blogDetailpage"])->name("blogDetailpage");

Route::post('enquiry-form',[EnquiryFormController::class,"enquiryDetails"])->name("saveEnquiryFormData");

Route::get("/activitiespage",[HomePageController::class,"activitiespage"])->name("activitiespage");
Route::get("activities/{slug}",[HomePageController::class,"activitiesDetailpage"])->name("activitiesDetailpage");


Route::post('/submit-query', [QueryController::class, 'submit'])->name('query.submit');



// require __DIR__.'/auth.php';

include_once "adminRoutes.php";

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
