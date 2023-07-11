<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventGallery extends Model
{

    protected $fillable = [
        'event_id', 'event_photo',
    ];








    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
