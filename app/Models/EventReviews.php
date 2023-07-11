<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventReviews extends Model
{

    protected $fillable = [
        'user_id', 'event_id', 'comment', 'stars'
    ];


    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
