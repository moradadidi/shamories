<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['profile_id', 'publication_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }
}

