<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index(){
        return view(
            'listings.index', 
            [
                'heading' => 'Latest Listings',
                'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(4),
            ]
        );
    }

    // Show Single Listings
    public function show(Listing $listing){
        return view('listings.show', [
            'listing' => $listing,
        ]);
    }

    // Create
    public function create(){
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => [
                'required', 
                Rule::unique('listings', 'company')
            ],
            'website' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required', 
            'description' => 'required',
        ]);

        if($request->hasfile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing]);
    }

    // Store Listing Data
    public function update(Request $request, Listing $listing){

        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'website' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required', 
            'description' => 'required',
        ]);

        if($request->hasfile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing Updated successfully!');
    }

    // Delete Listing
    public function delete(Listing $listing){

        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $listing->delete();

        return back()->with('message', 'Listing deleted Successfully');
    }

    public function manage(){
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}

