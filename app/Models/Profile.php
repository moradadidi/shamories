<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends User
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'bio', 'password', 'image', 'email_verified_at'];
    

    public function getImageAttribute($value)
    {
        return $value??'profile/default-profile.png';
    }

    public function publications()
    {
        
        return $this->hasMany(Publication::class);
        
    }
}
