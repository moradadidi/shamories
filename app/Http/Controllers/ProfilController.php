<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\profileMail;

use App\Http\Controllers\Controller; // Ensure this is correctly imported


class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['show']);
    }
    public function index()
    {
        $profiles = Profile::paginate(10);
        return view('profile.index', compact('profiles'));
    }

    public function show(Profile $profile)
    {
        
        return view('profile.show', compact('profile'));
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

        return redirect('/profiles')->with('success', 'Profile created successfully');
    }

    public function verify_email( string $hash){

        [$created_at, $id] =explode('///', base64_decode( $hash));
        $profile=Profile::findOrFail($id);
        
        // dd($created_at, $profile->created_at->toDateTimeString());
        if($created_at != $profile->created_at->toDateTimeString()){
            abort(403, 'Link Expired');
        }

        if($profile->email_verified_at != null){
            return view('profile.email_verified', compact('name', 'email'));
            
        }
        $name = $profile->name;
        $email = $profile->email;

        $profile->fill(['email_verified_at' => now()])->save();
        // dd($profile);

        return view('profile.email_verified', compact('name', 'email'));
       

    } 

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully');
    }

    public function edit(Profile $profile)
    {
        return view('profile.edit', compact('profile'));
    }

    public function update(ProfileRequest $request, Profile $profile)
    {
        $form_data = $request->validated();
        if ($request->hasFile('image')) {
            $form_data['image'] = $request->file('image')->store('profile', 'public');
        }
        if(!empty($request->password)){
        $form_data['password'] = Hash::make($request->password);
        }
        $profile->fill($form_data)->save();
        return redirect()->route('profiles.show', $profile->id)->with('success', 'Profile updated successfully');
    }
}
