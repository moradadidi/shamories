<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationRequest;
use App\Models\Profile;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\Save;
use App\Notifications\LikedNotification;
use App\Notifications\CommentedNotification;


class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Profile $profile )
    {
        
        $profiles = Profile::all()->except(Auth::id());
        $publications = Publication::latest()->get();
        $user  = Auth::guard('web')->user();

        // $user->follow = $profile->followers()->count();

       
        return view('publication.index', compact('publications', 'profiles'));
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
        $publication->loadCount('likes'); // This will add a likes_count attribute to the publication

        // dd($publication->likes_count);

        $profile = $publication->profile;
        $publications = DB::table('publications')->where('profile_id', Auth::id())->get();

        return view('publication.show', compact('profile', 'publications', 'publication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication, Request $request)
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
    
    
    

    public function comment(Request $request, Publication $publication)
    {
        $profile = Auth::guard('web')->user();
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = $publication->comments()->create([
            'profile_id' => Auth::user()->id,
            'content' => $request->content,
        ]);

        

        $publication->profile->notify(new CommentedNotification($comment->profile, $comment->content));
        // dd($comment->profile);

        return back();
    }
    
    public function like(Publication $publication)
    {
        $profile = Auth::guard('web')->user(); // Get the authenticated Profile object

        // Check if the profile has already liked the publication
        if ($profile->hasLiked($publication)) {
            // If already liked, remove the like
            $publication->likes()->where('profile_id', $profile->id)->delete(); // Remove based on profile ID
        } else {
            // Otherwise, like the publication
            $publication->likes()->create([
                'publication_id' => $publication->id,
                'profile_id' => $profile->id,
            ]);

            $publication->profile->notify(new LikedNotification($profile));
        }
        
       // Display the likes
        
        return back(); // Redirect back to the previous page
    }
    public function toggleSave(Request $request, $publicationId)
    {
        $user = Auth::guard('web')->user();
        $save = Save::where('profile_id', $user->id)->where('publication_id', $publicationId)->first();
    
        if ($save) {
            $save->delete();
            $message = 'Post unsaved';
            $status = 'unsaved';
        } else {
            Save::create([
                'profile_id' => $user->id,
                'publication_id' => $publicationId,
            ]);
            $message = 'Post saved';
            $status = 'saved';
        }
    
        return redirect()->back()->with([
            'message' => $message,
            'status' => $status,
        ]);
    }
    
    public function allSaves()
    {
        $saves = Save::with('publication', 'profile')->get();
        return view('publication.saves', compact('saves'));
    }

}
