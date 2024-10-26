<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\profileMail;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller; // Ensure this is correctly imported
use App\Models\Publication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FollowedNotification;
use App\Notifications\CommentedNotification;
use App\Notifications\LikeNotification;



class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['show']);
    }
    public function index(Request $request, Profile $profile)
    {
        $search = $request->input('search');

        // Check if there's a search query, if so, filter results
        $profiles = Profile::withCount(['followers', 'following']) // Eager load followers and following counts
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('profile.index', compact('profiles', 'profile'));
    }



    public function show(Profile $profile, Publication $publication)
    {
        $profile->count = $profile->publications()->count();
        $profile->comments = $profile->comments()->count();
        $profile->follow = $profile->followers()->count();
        // dd($publication);
        // $publications = DB::table('publications')->where('profile_id', Auth::id())->get();
        return view('profile.show', compact('profile', 'publication'));
    }
    public function create()
    {
        return view('profile.create');
    }

    public function store(ProfileRequest $request)
    {
        $request->validated();
        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('profile', 'public')
            : 'profile/default-profile.jpg';
        $profile = Profile::create([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
            'password' => Hash::make($request->password),
            'image' => $imagePath,
        ]);
        Mail::to('qRwX5@example.com')->send(new profileMail($profile));

        return redirect('/publications')->with('success', 'Profile created successfully');
    }

    public function verify_email(string $hash)
    {

        [$created_at, $id] = explode('///', base64_decode($hash));
        $profile = Profile::findOrFail($id);

        // dd($created_at, $profile->created_at->toDateTimeString());
        if ($created_at != $profile->created_at->toDateTimeString()) {
            abort(403, 'Link Expired');
        }

        if ($profile->email_verified_at != null) {
            return view('profile.email_verified', compact('name', 'email'));
        }
        $name = $profile->name;
        $email = $profile->email;

        $profile->fill(['email_verified_at' => now()])->save();
        // dd($profile);

        return view('profile.email_verified', compact('name', 'email'))->with('info', 'Email verified successfully.');
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()->route('profiles.index')->with('info', 'Profile deleted successfully');
    }

    public function edit(Profile $profile)
    {
        return view('profile.edit', compact('profile'));
    }

    public function update(ProfileRequest $request, Profile $profile)
    {
        $form_data = $request->validated(); // Only validated fields are retrieved

        // Handle the image separately if it's uploaded
        if ($request->hasFile('image')) {
            $form_data['image'] = $request->file('image')->store('profile', 'public');
        }

        // Only update the password if it's provided
        if (!empty($request->password)) {
            $form_data['password'] = Hash::make($request->password);
        } else {
            unset($form_data['password']); // Remove the password from form data if not provided
        }
        // Update the profile with the validated form data
        $profile->fill($form_data)->save();

        return redirect()->route('profiles.show', $profile->id)->with('success', 'Profile updated successfully');
    }


    public function follow(Profile $profile)
    {
        // Get the authenticated profile (assuming the authentication is set for Profile model)
        $currentProfile = Auth::guard('web')->user(); // This should return the Profile model, not User

        // Check if the current profile is already following the target profile
        if ($currentProfile->isFollowing($profile)) {
            // If already following, unfollow the profile
            $currentProfile->following()->detach($profile->id);
        } else {
            // Otherwise, follow the profile
            $currentProfile->following()->attach($profile->id);
        }
        $profile->notify(new FollowedNotification($currentProfile));
        
        // Redirect back to the previous page with success status
        return redirect()->back()->with('success', 'You are now following this profile!');
    }
    
    public function getNotifications()
    {

        // Get unread notifications for the authenticated user
        $notifications = Auth::user()->unreadNotifications;
        


        return view('partials.nav', compact('notifications'));
    }
    // In ProfilController.php

    public function allNotifications()
    {
        // Query the notifications table and paginate the result
        $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->paginate(10);
    
        return view('notifications.all', compact('notifications'));
    }
    
    

}
