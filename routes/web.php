<?php

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
*/

// All Listings
Route::get('/', function () {
    return view(
        'listings', 
        [
            'heading' => 'Latest Listings',
            'listings' => Listing::all(),
        ]
    );
});

Route::get('/listing/{listing}', function(Listing $listing){
    return view('listing', [
        'listing' => $listing,
    ]);
});

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