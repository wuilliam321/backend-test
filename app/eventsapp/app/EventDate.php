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

    static function getHighlightedEvents()
    {
        return self::join('events', 'events.id', '=', 'event_dates.event_id')
            ->select('events.*', 'event_dates.*')
            ->where('date', '>=', Carbon::today())
            ->where('is_highlighted', 1)
            ->get();
    }
}
