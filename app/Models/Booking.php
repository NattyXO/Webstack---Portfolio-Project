<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $fillable = [
        'event_id', 'economy_count', 'vip_count', 'user_id',
        'completed', 'booking_token', 'qrcode'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bookinghistory()
    {
        return $this->hasMany(BookingHistory::class);
    }
}
