<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Mail\profileMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     private const  CACHE_KEY = 'profiles_api';
    public function index()
    {
        $profiles=Cache::remember(self::CACHE_KEY, 14400, function () {
            return ProfileResource::collection(Profile::all());

        });
        return $profiles;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form_data = $request->all();

        $form_data['password'] = Hash::make($request->password);

        $profile = Profile::create($form_data);
        Cache::forget(self::CACHE_KEY);
        Mail::to('qRwX5@example.com')->send(new profileMail($profile));

        return new ProfileResource($profile);
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        return new ProfileResource($profile);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $form_data = $request->all();

        $form_data['password'] = Hash::make($request->password);

        $profile->fill($form_data)->save();
        Cache::forget(self::CACHE_KEY);

        return new ProfileResource($profile);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        Cache::forget(self::CACHE_KEY);

        return response()->json(['message' => 'Profile deleted successfully']);
    }
}
