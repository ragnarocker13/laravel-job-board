<?php

use App\Models\Listing;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hellomundo', function () {
    return 'Hello Kamunduhan!';
});

// returns a response
Route::get('/helloresponse', function () {
    return response('<h1>403 HELLO RESPONSE! This is running from a response request</h1>', 403)
    ->header('Content-Type', 'text/plain')
    ->header('fizz', 'buzz');
});

// you can also add some conditions using Where
Route::get('/posts/{id}', function ($id) {
    // debugging ddd() or ddd()
    dd($id);
    return response('<h1>This is for post number ' . $id . '</h1>');
})->where('id', '[0-9]+');

Route::get('/search', function () {
    return 'Hello Kamunduhan!';
});

Route::get('/jsoncall/{name}/{lname}', function ($name, $lname) {

    // return ('<h1>Heres your API ' . $name . '</h1>');            
    return response()->json([
            'name' => $name,
            'surname' => $lname,
            'midname' => 'Basco'
        ]);
});


// Show create form
// An alternative to access the route to logged in users by adding ->middleware('auth');
// This will automatically redirect all non authenticated users to the named 'login' page
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store route for POST method in submitting forms
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Retrieve all the listings in database
Route::get('/', [ListingController::class, 'index']);

// Show edit form and retrieve existing data
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'delete'])->middleware('auth');

// A new route to retrieve listings by id number
Route::get('/listing/{listing}', [ListingController::class, 'show']);

// Show Register and Create Form
// Middleware('guest') will rediredt authenticated users to the 'home' page
// Prevents logged in users to access the register route, redirects to the home page
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create new users
Route::post('/users', [UserController::class, 'store']);

// User logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show the login form
// Prevents logged in users to access the login route, redirects to the home page
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Login method
Route::post('/users/authenticate', [UserController::class, 'authenticate']);