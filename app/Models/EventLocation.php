<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model
{

    protected $fillable = [
        'city', 'street', 'venue', 'latitude', 'longitude'
    ];




    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
