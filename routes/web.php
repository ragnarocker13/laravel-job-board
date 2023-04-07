<?php

use App\Models\Listing;

use Illuminate\Support\Facades\Route;
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

// Retrieve all the listings in database
Route::get('/listings', [ListingController::class, 'index']);

// A new route to retrieve listings by id number
Route::get('/listing/{listing}', [ListingController::class, 'show']);