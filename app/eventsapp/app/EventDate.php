<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EventDate extends Model
{
    /**
     * @return array
     */
    public function getDateForEventCard()
    {
        $time = Carbon::parse($this->date);
        return $time->format('M j @ H:i');
    }

    /**
     * @return array
     */
    public function getTime()
    {
        $time = Carbon::parse($this->date);
        return $time->format('H:i');
    }

    /**
     * @return array
     */
    public function getDate()
    {
        $time = Carbon::parse($this->date);
        return $time->format('M j');
    }

    /**
     * Get the event for the date.
     */
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
