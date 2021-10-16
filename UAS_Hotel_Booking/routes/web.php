<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\OrderController;

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

//
Route::get('/', [HomeController::class, 'index'])->middleware('userLoggedIn');

// ------ AdminLte page ------
//Route::get('/adminlte', [AdminController::class, 'index'])->name('adminlte')->middleware('isLogged');

Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('adminLoggedIn');
Route::get('/user/detail/{id}', [UserController::class, 'detail'])->middleware('adminLoggedIn');
Route::get('/user/add', [UserController::class, 'addPage'])->middleware('adminLoggedIn');
Route::post('/user/add/submit', [UserController::class, 'addData'])->middleware('adminLoggedIn');
Route::get('/user/edit/{id}', [UserController::class, 'editPage'])->middleware('adminLoggedIn');
Route::post('/user/edit/submit{id}', [UserController::class, 'editData'])->middleware('adminLoggedIn');
Route::get('/user/delete/{id}', [UserController::class, 'deleteData'])->middleware('adminLoggedIn');

Route::get('/booking', [BookingController::class, 'index'])->name('booking')->middleware('adminLoggedIn');
Route::get('/booking/detail/{booking_id}', [BookingController::class, 'detail'])->middleware('adminLoggedIn');
Route::get('/booking/add', [BookingController::class, 'addPage'])->middleware('adminLoggedIn');
Route::post('/booking/add/submit', [BookingController::class, 'addData'])->middleware('adminLoggedIn');
Route::get('/booking/edit/{booking_id}', [BookingController::class, 'editPage'])->middleware('adminLoggedIn');
Route::post('/booking/edit/submit{booking_id}', [BookingController::class, 'editData'])->middleware('adminLoggedIn');
Route::get('/booking/delete/{booking_id}', [BookingController::class, 'deleteData'])->middleware('adminLoggedIn');
Route::get('/booking/printpdf', [BookingController::class, 'print'])->middleware('adminLoggedIn');

Route::get('/hotel', [HotelController::class, 'index'])->name('hotel')->middleware('adminLoggedIn');
Route::get('/hotel/detail/{id}', [HotelController::class, 'detail'])->middleware('adminLoggedIn');
Route::get('/hotel/add', [HotelController::class, 'addPage'])->middleware('adminLoggedIn');
Route::post('/hotel/add/submit', [HotelController::class, 'addData'])->middleware('adminLoggedIn');
Route::get('/hotel/edit/{id}', [HotelController::class, 'editPage'])->middleware('adminLoggedIn');
Route::post('/hotel/edit/submit{id}', [HotelController::class, 'editData'])->middleware('adminLoggedIn');
Route::get('/hotel/delete/{id}', [HotelController::class, 'deleteData'])->middleware('adminLoggedIn');

Route::get('/room', [RoomController::class, 'index'])->name('room')->middleware('adminLoggedIn');
Route::get('/room/detail/{room_id}', [RoomController::class, 'detail'])->middleware('adminLoggedIn');
Route::get('/room/add', [RoomController::class, 'addPage'])->middleware('adminLoggedIn');
Route::post('/room/add/submit', [RoomController::class, 'addData'])->middleware('adminLoggedIn');
Route::get('/room/edit/{room_id}', [RoomController::class, 'editPage'])->middleware('adminLoggedIn');
Route::post('/room/edit/submit{room_id}', [RoomController::class, 'editData'])->middleware('adminLoggedIn');
Route::get('/room/delete/{room_id}', [RoomController::class, 'deleteData'])->middleware('adminLoggedIn');


// Searching function on adminlte 
Route::get('/search', [UserController::class, 'search'])->name('search')->middleware('adminLoggedIn');
Route::get('/searchRoom', [RoomController::class, 'searchRoom'])->name('searchRoom')->middleware('adminLoggedIn');

// Route Login & register page
Route::get('/login', [UserAuthController::class, 'login'])->middleware('alreadyLoggedIn');
Route::get('/register', [UserAuthController::class, 'register'])->middleware('alreadyLoggedIn');
Route::post('/registerUser', [UserAuthController::class, 'registerUser'])->name('registerUser')->middleware('alreadyLoggedIn');
Route::post('/loginUser', [UserAuthController::class, 'loginUser'])->name('loginUser')->middleware('alreadyLoggedIn');

Route::get('/profile', [UserAuthController::class, 'profile'])->middleware('isLogged');
Route::get('/profile-edit/{id}', [UserAuthController::class, 'editProfilePage'])->middleware('isLogged');
Route::post('/profile-edit/submit{id}', [UserAuthController::class, 'editProfile'])->middleware('isLogged');
Route::get('/logout', [UserAuthController::class, 'logout']);

// AboutUs page 
Route::get('/aboutUs', [HomeController::class, 'aboutUsPage']);

// User Order Functions 
Route::get('/order', [OrderController:: class, 'index'])->middleware('isLogged');
Route::get('/order-booking/{id}', [OrderController:: class, 'bookingHotelPage']);
Route::post('/order-booking/submit{id}', [OrderController:: class, 'addBookingHotel'])->middleware('isLogged');
Route::get('/order/printpdf/{bookimg_id}', [OrderController::class, 'print'])->middleware('isLogged');
Route::get('/delete-booking/{booking_id}', [OrderController::class, 'deleteBooking'])->middleware('isLogged');

