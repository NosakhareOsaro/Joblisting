<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JoblistingController;

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

//Route::get('/', function () {
    //return view('welcome');
//});

// All Listings
Route::get('/', [JoblistingController::class, 'index']);

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Create New User
Route::post('/users', [UserController::class, 'store']);


// Show Create Form
Route::get('/joblistings/create', [JoblistingController::class, 'create'])->middleware('auth');

// Store Listing Data
Route::post('/joblistings', [JoblistingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/joblistings/{joblisting}/edit', [JoblistingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/joblistings/{joblisting}', [JoblistingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/joblistings/{joblisting}', [JoblistingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/joblistings/manage', [JoblistingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/joblistings/{joblisting}', [JoblistingController::class, 'show']);