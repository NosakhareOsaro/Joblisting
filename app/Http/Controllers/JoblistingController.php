<?php

namespace App\Http\Controllers;

use App\Models\Joblisting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JoblistingController extends Controller
{
    // Show all listings
    public function index() {
        return view('Joblistings.index', [
           'joblistings' => Joblisting::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]
    );
    }

    //Show single listing
    public function show(Joblisting $joblisting) {
        return view('Joblistings.show', [
            'joblisting' => $joblisting
        ]);
    }

    // Show Create Form
    public function create() {
        return view('Joblistings.create');
    }

    // Store Listing Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('joblistings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Joblisting::create($formFields);

        return redirect('/')->with('message', 'Job Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Joblisting $joblisting) {
        return view('Joblistings.edit', ['joblisting' => $joblisting]);
    }

    // Update Listing Data
    public function update(Request $request, Joblisting $joblisting) {
        // Make sure logged in user is owner
        if($joblisting->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $joblisting->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete Listing
    public function destroy(Joblisting $joblisting) {
        // Make sure logged in user is owner
        if($joblisting->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $joblisting->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    // Manage Listings
    public function manage() {
        return view('Joblistings.manage', ['joblistings' => auth()->user()->Joblistings()->get()]);
    }
}