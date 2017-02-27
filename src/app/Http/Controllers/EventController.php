<?php

namespace SeanDowney\BackpackEventsCrud\app\Http\Controllers;

use SeanDowney\BackpackEventsCrud\app\Models\Event;
use App\Http\Controllers\Controller;

class EventController extends Controller
{

    public function index()
    {
        // Get all the events
        $events = Event::with('venue')->published()->latest()->paginate();

        // Show the page
        return view('seandowney::eventscrud.index', compact('events'));
    }


    public function view($slug)
    {
        $event = Event::with('venue')->whereSlug($slug)->published()->first();

        if (!$event) {
            abort(404, 'Please go back to our <a href="'.url('/').'">homepage</a>.');
        }

        // get the venue details
        $event->venue = $event->venue->withFakes();
        $this->data['event'] = $event;
        $this->data['display_ticket_form'] = $event->hasValidTickets();
        $this->data['ticket_vendors'] = config('seandowney.eventscrud.ticket_vendors');

        return view('seandowney::eventscrud.event', $this->data);
    }
}
