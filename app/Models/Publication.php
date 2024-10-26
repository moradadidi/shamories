<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Profile;

class Publication extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'titre',
        'body',
        'image',
        'profile_id',
    ];


    public function profile()
    {
        return $this->belongsTo(Profile::class);
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

}
