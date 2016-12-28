<?php

namespace SeanDowney\BackpackEventsCrud\app\Http\Controllers;

use SeanDowney\BackpackEventsCrud\app\Models\Event;
use App\Http\Controllers\Controller;

class EventController extends Controller
{

    public function index()
    {
        // Get all the events
        $events = Event::published()->latest()->paginate();

        // Show the page
        return view('seandowney::eventscrud.index', compact('events'));
    }


    public function view($slug)
    {
        $event = Event::whereSlug($slug)->published()->first();

        if (!$event) {
            abort(404, 'Please go back to our <a href="'.url('/').'">homepage</a>.');
        }

        $this->data['event'] = $event;

        // get the venue for the event
        $venues_array = config('seandowney.eventscrud.venues');
        $this->data['ticket_vendors'] = config('seandowney.eventscrud.ticket_vendors');
        if (!is_null($event->venue_id) && isset($venues_array[$event->venue_id])) {
            $this->data['venue'] = $venues_array[$event->venue_id];
        }

        $display_tickets = false;
        if (!is_null($event->ticket_vendor) && !is_null($event->ticket_vendor_id) && $event->start_time > date("Y-m-d H:i:s")) {
            $display_tickets = true;
        }

        $this->data['display_ticket_form'] = $display_tickets;

        return view('seandowney::eventscrud.event', $this->data);
    }
}
