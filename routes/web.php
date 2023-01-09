<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

// // Custom Headers
// Route::get('/hello', function() {
//     return response("<h1>Hello World</h1>", 200)
//         ->header('Content-Type', 'text/plain');
// });

// // wildcards and regex constraints
// Route::get('/posts/{id}', function($id){
//     dd($id);
//     return response('Post: ' . $id);
// })->where('id', '[0-9]+');

// // Query Parameters
// Route::get('/search', function(Request $request){    
//     return $request->name . ' ' . $request->city;
// });
*/

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show Create Form
Route::get('/listing/create', [ListingController::class, 'create']);

// Store Listing data
Route::post('/listings', [ListingController::class, 'store']);

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

// Update Edit Form
Route::put('/listings/{listing}', [ListingController::class, 'update']);

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'delete']);

// Show Single Listing
Route::get('/listing/{listing}', [ListingController::class, 'show']);

// Show Register/Create Form\
Route::get('/register', [UserController::Class, 'create']);