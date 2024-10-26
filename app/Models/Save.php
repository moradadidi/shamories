<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'publication_id',
    ];

    public function saves()
{
    return $this->hasMany(Save::class);
}
public function profile()
{
    return $this->belongsTo(Profile::class);
}

public function publication()
{
    return $this->belongsTo(Publication::class);
}

}
