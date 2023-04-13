<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // show all listings
    // replace paginate() with get() to see all retrieved queries
    // you can use simplePaginate or paginate()
    // install styling using php artisan vendor:publish and choose PaginationServiceProvider
    public function index() {
        return view('listings.index', [
            'heading' => 'Latest Listings in Blade',
            'listings' => Listing::latest()->filter(request(['tag']))->paginate(6)
        ]);
    }

    // show a single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Store listing Data
    public function store(Request $request) {
        // just to test if all parameters are being passed
        // dd($request->all());

        $formFields = $request->validate([
            'title' => 'required',
            // you can pass in some values from the method Rule::unique
            // passing the table name and field that should appear as unique
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            // required, but format shoud be in email format
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();
        
        // execute to pass the formFields data and create an entry
        Listing::create($formFields);
        
        // redirect it to the root URL with some errors returned
        // return redirect('/listings');
        
        // this will display a flash message instead of just redirecting to the listings page
        return redirect('/')->with('message', 'Listing created Successfully!');
        
    }
    
    // Show create form
    public function create() {
        return view('listings.create');
    }
    
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }
    
    // Delete Method
    public function delete(Listing $listing) {

        // Make sure that the logged in user is the owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();

        return redirect('/')->with('message', 'Listing removed successfully');
    }
    
    // Update listing Data
    public function update(Request $request, Listing $listing) {

        // Make sure that the logged in user is the owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
       
        $listing->update($formFields);        
     
        return back()->with('message', 'Listing updated Successfully!');
    }

    // Return the manage listings view then pass in the listings of that user using auth()
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}