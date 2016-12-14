<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'is_highlighted' => 'boolean',
//    ];

    /**
     * Get the event dates for the event.
     */
    public function event_dates()
    {
        return $this->hasMany('App\EventDate');
    }
}
