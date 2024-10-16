<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationRequest;
use App\Models\Profile;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = Publication::latest()->get();
        return view('publication.index', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publication.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublicationRequest $request)
    {
        // Validate the request
        $formFeild = $request->validated();
        $formFeild['profile_id'] = Auth::id();

        // Initialize the image path to null in case no image is uploaded
        $imagePath = null;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('publication', 'public');
        }

        // Create the publication
        Publication::create([
            'titre' => $formFeild['title'],
            'body' => $formFeild['body'],
            'image' => $imagePath,
            'profile_id' => $formFeild['profile_id']
        ]);

        // Redirect to the publications list with a success message
        return to_route('publications.index')->with('success', 'Publication created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        $profile = $publication->profile;
        $publications = DB::table('publications')->where('profile_id', Auth::id())->get();

        return view('publication.show', compact('profile', 'publications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication , Request $request)
    {
        if ($request->user()->can('update', $publication)) {
            abort(404);
        }
        return view('publication.edit', compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublicationRequest $request, Publication $publication)
    {
        // Validate the request
        $formFeild = $request->validated();

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $formFeild['image'] = $request->file('image')->store('publication', 'public');
        } else {
            // Keep the old image if no new image is uploaded
            $formFeild['image'] = $publication->image;
        }

        // Ensure you're updating the correct field names
        $publication->titre = $formFeild['title'];  // Assuming 'title' is the form field for 'titre' in the database
        $publication->body = $formFeild['body'];    // Assuming 'body' is fine as-is

        // Save the updated publication
        $isUpdated = $publication->save();

        // Check if the save was successful
        if (!$isUpdated) {
            return redirect()->back()->with('error', 'Publication not updated');
        }

        // Redirect to the publications index with a success message
        return redirect()->route('publications.index')->with('success', 'Publication updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        $publication->delete();
        return redirect()->route('publications.index')->with('success', 'Publication deleted successfully');
    }
}
