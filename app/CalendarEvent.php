<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model implements \MaddHatter\LaravelFullcalendar\Event
{
    //
    public function getEventOptions()
    {
        return [
            'color' => $this->background_color,
            //etc
        ];
    }   
    
}
