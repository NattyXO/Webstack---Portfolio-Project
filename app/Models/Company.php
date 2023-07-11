<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = [
        'name', 'bio', 'owner',
        'prof_pic', 'cover_pic',
        'rating',
    ];




    // relationships
    public function admins()
    {
        return $this->belongsToMany(User::class);
    }
}
