<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{

    protected $fillable = [
        'booking_id', 'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
