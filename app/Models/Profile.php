<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = [
        'phone_number', 'profile_pic', 'bio'
    ];





    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
