<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
        'user_id', 'company_id', 'title', 'desc', 'approved',
        'event_start_time', 'event_end_time', 'approved_by',
        'event_deadline', 'economy_seats', 'economy_price',
        'vip_seats', 'vip_price'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function location()
    {
        return $this->hasOne(EventLocation::class);
    }

    public function gallery()
    {
        return $this->hasMany(EventGallery::class);
    }

    public function reviews()
    {
        return $this->hasMany(EventReviews::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
