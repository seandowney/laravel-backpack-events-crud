<?php

return [

    /*
    | Dowser/EventsCrud configs.
    */

    /**
     * Venues
     */
    'venues' => [
		1 => [
            'id' => 1,
			'title' => 'The Venue',
			'description' => "What a wonderful venue.",
			'address' => [
				'address1' => 'The Building',
				'address2' => 'The Street',
				'town'     => 'The Town',
				'county'   => 'The County',
			],
			'url' => 'http://www.thevenue.ie/',
			'phone' => '+353 (0)12 1212 1212',
			'coordinates' => [
				'lat' => '',
				'lon' => '',
			],
            // html for the iframe of a Goolge map
			'map' => '',
		],
	],

    /**
     * Ticket Service providers
     * Used to handle the partial views
     */
	'ticket_vendors' => [
		1 => 'eventbrite',
		2 => 'tito',
	],
];
