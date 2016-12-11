<?php

namespace Dowser\BackpackEventsCrud\app\Http\Controllers;

use Dowser\BackpackEventsCrud\app\Models\Event;

class EventController extends Controller
{

    public function index()
    {
        // Get all the blog posts
		$events = Event::published()->paginate();

		// Show the page
		return view('events.index', compact('events'));
    }


    public function view($slug)
    {
        $event = Event::whereSlug($slug)->first();

        if (!$event)
        {
            // abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        }

        $this->data['event'] = $event;

        // get the venue for the event
		$venues_array = config('events.venues');
		$this->data['ticket_vendors'] = config('events.ticket_vendors');
		$this->data['venue'] = $venues_array[$event->venue_id];

        $display_tickets = false;
        if ($event->ticket_vendor > 0 && isset($event->ticket_vendor_id) && $event->start_time > date("Y-m-d H:i:s")) {
            $display_tickets = true;
        }

        $this->data['display_ticket_form'] = $display_tickets;

        return view('events.event', $this->data);
    }
}
