<?php

namespace App\Http\Controllers;


class CalendarController extends Controller
{
    
    public function getCalendar(){
        $events = [];
    
        $events[] = \Calendar::event(
            'Event One', //event title
            false, //full day event?
            '2015-02-11T0800', //start time (you can also use Carbon instead of DateTime)
            '2015-02-12T0800', //end time (you can also use Carbon instead of DateTime)
            0 //optionally, you can specify an event ID
        );
        
        $events[] = \Calendar::event(
            "Valentine's Day", //event title
            true, //full day event?
            new \DateTime('2015-02-14'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2015-02-14'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId' //optionally, you can specify an event ID
        );
        
        // $eloquentEvent = EventModel; //EventModel implements MaddHatter\LaravelFullcalendar\Event
        
        $calendar = \Calendar::addEvents($events) //add an array with addEvents
            ;
        
        return view('cal', compact('calendar'));
    }
}

class EventModel implements \MaddHatter\LaravelFullcalendar\Event
{

    protected $dates = ['start', 'end'];

    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }
}
