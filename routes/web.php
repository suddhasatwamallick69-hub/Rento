<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RCController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Session;

//User Routes
Route::middleware(['ReturnHostIfAuthenticated','PreventBackHistory'])->group(function () {
    Route::get('/',[UserController::class,'index'])->name('index');
    Route::get('/about',[UserController::class,'about'])->name('about');
    Route::get('/vehicles', [UserController::class, 'listofvehicles'])->name('listofvehicles');
    Route::get('/myprofile', [UserController::class, 'myprofile'])->name('myprofile');
    Route::get('/booking', [UserController::class, 'booking'])->name('booking');
    Route::post('/booking/payments', [PaymentController::class, 'booking_payments'])->name('booking_payments');
    Route::get('/payments/payment_options', [PaymentController::class, 'payments'])->name('payments');
    Route::get('/mybookings', [UserController::class, 'mybooking'])->name('allbookings');
    Route::get('/trip/{bid}', [UserController::class, 'trip'])->name('trip');
    Route::get('/endtrip', [UserController::class, 'endtrip'])->name('endtrip');
});



Route::middleware(['guest','PreventBackHistory'])->group(function () {
    Route::get('/login_register',[UserController::class,'login_register'])->name('login_register');
    Route::get('authenticate',[UserController::class,'authenticate'])->middleware('CheckOtpSession')->name('authenticate');
});

Route::middleware(['auth','PreventBackHistory'])->group(function () {
    Route::get('/logout_user', [UserController::class, 'logout_user'])->name('logout_user');
    Route::get('/verifyprofile',[UserController::class,'verifyprofile'])->name('verifyprofile');
});

Route::post('/search', [UserController::class, 'ins_search'])->name('ins_search');
Route::post('/search-vehicles', [UserController::class, 'search_category'])->name('search_category');
Route::post('/search_by_fuel_type', [UserController::class, 'search_by_fuel_type'])->name('search_by_fuel_type');
Route::post('otp_verification',[UserController::class,'otp_verification'])->name('otp_verification');
Route::post('register',[UserController::class,'register'])->name('register');
Route::post('/login_auth_user',[UserController::class,'login'])->name('login_auth_user');
Route::post('/updateprofile',[UserController::class,'updateprofile'])->name('updateprofile');
Route::post('ins_verifyprofile',[UserController::class,'ins_verifyprofile'])->name('ins_verifyprofile');

Route::post('/increment-payment-count', function (Request $request) {
    session()->increment('paymentcount');
})->name("increment_payment_count");

Route::post('/payment-status', [PaymentController::class, 'payment_status'])->name('payment_status');


    







//Host Routes

Route::middleware(['checkHost','PreventBackHistory'])->group(function () {
    Route::get('/host/dashboard',[HostController::class,'hostdashboard'])->name('hostdashboard');
    Route::get('/host/profile',[HostController::class,'myhostprofile'])->name('myhostprofile');
    Route::get('/host/bookings',[HostController::class,'hostbookings'])->name('hostbookings');
    Route::get('/host/myvehicles',[HostController::class,'myvehicles'])->name('myvehicles');
    Route::get('/host/vehicle_details/{vid}', [HostController::class, 'vehicle_details'])->name('host_vehicle_details');
});

Route::middleware(['ReturnHostIfAuthenticated','PreventBackHistory'])->group(function () {
    Route::get('/host/register',[HostController::class,'host'])->name('host');
    Route::get('/host/login',[HostController::class,'hlogin'])->name('hlogin');
});

Route::post('/host/verifyprofile',[HostController::class,'ins_hostverifyprofile'])->name('ins_hostverifyprofile');
Route::post('/host/hostupdateprofile',[HostController::class,'hostupdateprofile'])->name('hostupdateprofile');
Route::post('/host/register',[HostController::class,'host_register'])->name('host_register');

Route::get('/host/verifyclient',[HostController::class,'verifyclient'])->name('verifyclient');
Route::get('/host/authenticate_client',[HostController::class,'authenticate_client'])->name('authenticate_client');
Route::post('/host/ins_authenticate_client',[HostController::class,'ins_authenticate_client'])->name('ins_authenticate_client');
Route::post('/host/resend_otp_for_authenticating_client',[HostController::class,'resend_otp_for_authenticating_client'])->name('resend_otp_for_authenticating_client');

Route::post('/host/inslogin',[HostController::class,'host_inslogin'])->name('host_inslogin');

Route::get('/host/authenticate',[HostController::class,'host_authenticate'])->name('host_authenticate');
Route::post('/host/otp_verification',[HostController::class,'host_otp_verification'])->name('host_otp_verification');

Route::get('/host/hostvehicle',[HostController::class,'hostvehicle'])->name('hostvehicle');
Route::post('/ins_hostvehicle',[HostController::class,'ins_hostvehicle'])->name('ins_hostvehicle');
Route::get('host/logout_host', [HostController::class, 'logout_host'])->name('logout_host');


Route::post('/host/endtrip', [HostController::class, 'end_trip_otp'])->name('end_trip_otp');
Route::get('host/authenticate_return',[HostController::class,'authenticate_return'])->name('authenticate_return');
Route::post('host/ins_trip_end_otp',[HostController::class,'ins_trip_end_otp'])->name('ins_trip_end_otp');











//Admin Routes

Route::middleware(['isAdmin','PreventBackHistory'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/admin/about', [AdminController::class, 'about'])->name('admin_about');
    Route::get('/admin/addvehiclecategory', [AdminController::class, 'addvehiclecategory'])->name('addvehiclecategory');
    Route::get("/admin/list_category",[AdminController::class,"list_category"])->name("list_category");
    Route::get('/admin/list_vehicle', [AdminController::class, 'list_vehicle'])->name('list_vehicle');
    Route::get('/admin/vehicle_details/{vid}', [AdminController::class, 'vehicle_details'])->name('vehicle_details');
    Route::get('/admin/manage_vehicle', [AdminController::class, 'manage_vehicle'])->name('manage_vehicle');
    Route::post('/admin/update_vehicle/', [AdminController::class, 'update_vehicle'])->name('admin_update_vehicle');
});

// Restrict login and register pages to guests only
Route::middleware(['RedirectAdminIfAuthenticated','PreventBackHistory'])->group(function () {
    Route::get('/admin', [AdminController::class, 'login'])->name('login');
});
Route::get('/admin/search_by_listing',[AdminController::class,'search_by_listing'])->name('admin_search_by_listing');
Route::get('/admin/search_by_approval',[AdminController::class,'search_by_approval'])->name('admin_search_by_approval');
Route::get('/admin/search_by_validity',[AdminController::class,'search_by_validity'])->name('admin_search_by_validity');
Route::get('/admin/search_by_host_name',[AdminController::class,'search_by_host_name'])->name('admin_search_by_host_name');
Route::post('/admin/login_auth',[AdminController::class,'login_auth'])->name('login_auth');
Route::post('/admin/ins_addvehicle_category',[AdminController::class,'vehicle_category_submit'])->name('vehicle_category_submit');
Route::post('/admin/approvevehicle', [AdminController::class, 'approvevehicle'])->name('approvevehicle');
Route::post('/admin/rejectvehicle', [AdminController::class, 'rejectvehicle'])->name('
rejectvehicle');
Route::post('/admin/set_price', [AdminController::class, 'set_price'])->name('set_price');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/403', function () {
    return view('403');
})->name('error');
Route::fallback(function () {
    // return redirect()->route('error');
    return redirect()->back();
});

Route::post('/upload-rc', [RCController::class, 'uploadRC'])->name('upload.rc');
Route::get('/welcome',[UserController::class,'welcome'])->name('welcome');

