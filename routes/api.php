<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventReviewsController;
use App\Http\Controllers\ProfileController;

// for flutter...
// php artisan serve --host 10.240.69.33 --port 80

// USER : login & sign up
Route::post('/auth/register', [AuthController::class, 'register']); // sign up
Route::post('/auth/login', [AuthController::class, 'login']); // login



// Protected Routes <=== AUTHENTICATION NEEDED to acces these routes
Route::group(['middleware' => ['auth:sanctum']], function () {



    // auth needed for logging out
    Route::post('/auth/logout', [AuthController::class, 'logout']);



    // EVENT ////////////////////////////////////////////////////////////////
    // Event : index : lists all events
    Route::get('/events', [EventController::class, 'index']);
    // Event : create
    Route::post('/events/add', [EventController::class, 'createEvent']);
    // Event : edit
    Route::post('/events/{event_id}', [EventController::class, 'editEvent']);
    // Event : get info about a single event
    Route::get('/events/{event_id}', [EventController::class, 'singleEvent']);
    // Event : delete
    Route::delete('/events/{event_id}', [EventController::class, 'deleteEvent']);
    // Event : search accross events using a KEY var
    Route::get('/events/search/{key}', [EventController::class, 'search']);



    // Company ///////////////////////////////////////////////////////////////
    // Company : index : lists all companies
    Route::get('/companies', [CompanyController::class, 'index']);
    // Company : create
    Route::post('/companies/add', [CompanyController::class, 'createCompany']);
    // Company : edit
    Route::post('/companies/{company_id}', [CompanyController::class, 'editCompany']);
    // Company : get info about a single company
    Route::get('/companies/{company_id}', [CompanyController::class, 'singleCompany']);
    // Company : delete
    Route::delete('/companies/{company_id}', [CompanyController::class, 'deleteCompany']);
    // Company : search : search accross companies using a KEY var
    Route::get('/companies/search/{key}', [CompanyController::class, 'search']);



    // Profile ///////////////////////////////////////////////////////////////
    Route::post('/profile/edit', [ProfileController::class, 'editProfile']);
    Route::post('/profile/get', [ProfileController::class, 'getProfile']);



    // Booking ///////////////////////////////////////////////////////////////
    // routes order matters !
    Route::post('/bookings/mine', [BookingController::class, 'myBookings']); // my bookings
    Route::post('/bookings/add', [BookingController::class, 'createBooking']); // create booking
    Route::get('/bookings/{id}', [BookingController::class, 'getBooking']); // get booking info by ID
    Route::post('/bookings/{id}', [BookingController::class, 'editBooking']); // update booking



    // Event Reviews ///////////////////////////////////////////////////////////////
    Route::get('/event/{id}/ratings/', [EventReviewsController::class, 'getReviews']); // get reviews
    Route::post('/event/{id}/ratings/', [EventReviewsController::class, 'addReviews']); // add review
    Route::post('/event/{id}/ratings/{rev_id}', [EventReviewsController::class, 'editReviews']); // edit review
    Route::delete('/event/{id}/ratings/{rev_id}', [EventReviewsController::class, 'deleteReview']); // delete review



    // Category ///////////////////////////////////////////////////////////////
    Route::get('/category/all', [CategoryController::class, 'list']); // list categories
    Route::post('/category/add', [CategoryController::class, 'addCategory']); // add a new category
    Route::delete('/category/{id}', [CategoryController::class, 'delCategory']); // delete a category



    // Filter ///////////////////////////////////////////////////////////////





















    // 
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
