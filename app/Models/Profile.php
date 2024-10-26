<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Profile extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $fillable = ['name', 'email', 'bio', 'password', 'image', 'email_verified_at','location','occupation','university'];

    public function getImageAttribute($value)
    {
        return $value ?? 'profile/default-profile.png';
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    function following()
    {
        return $this->belongsToMany(Profile::class, 'profile_follower', 'follower_id', 'profile_id');
    }

    public function isFollowing(Profile $profile)
    {
        return $this->following()->where('profile_id', $profile->id)->exists();
    }
    
    public function followers()
    {
        // Profiles that are following this user
        return $this->belongsToMany(Profile::class, 'profile_follower', 'profile_id', 'follower_id');
    }
    
   
    
    public function isFollowedBy(Profile $profile)
    {
        // Check if the profile is in the list of followers
        return $this->followers()->where('follower_id', $profile->id)->exists();
    }
    

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function hasLiked(Publication $publication)
    {
        return $this->likes()->where('publication_id', $publication->id)->exists();
    }

    public function saves()
    {
        return $this->hasMany(Save::class);
    }

    public function hasSaved(Publication $publication)
    {
        return $this->saves()->where('publication_id', $publication->id)->exists();
    }

    public function getProfileImageUrlAttribute()
{
    return $this->image 
        ? asset('storage/' . $this->image)  // Assuming the image is stored in the 'storage' folder
        : asset('images/default-profile.png');  // Default image if none exists
}

}

