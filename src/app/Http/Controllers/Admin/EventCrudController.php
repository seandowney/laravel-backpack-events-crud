<?php

namespace Dowser\BackpackEventsCrud\app\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use Dowser\BackpackEventsCrud\app\Http\Requests\EventRequest as StoreRequest;
use Dowser\BackpackEventsCrud\app\Http\Requests\EventRequest as UpdateRequest;

class EventCrudController extends CrudController {

	public function setUp() {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("Dowser\BackpackEventsCrud\app\Models\Event");
        $this->crud->setRoute(config('backpack.base.route_prefix').'/event');
        $this->crud->setEntityNameStrings('event', 'events');

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/

		// $this->crud->setFromDb();

		// ------ CRUD FIELDS
        $this->crud->addField([    // TEXT
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text',
            'placeholder' => 'Your title here',
        ]);
        $this->crud->addField([
            'name' => 'slug',
            'label' => 'Slug (URL)',
            'type' => 'text',
            'hint' => 'Will be automatically generated from your title, if left empty.',
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'speaker',
            'label' => 'Speaker',
            'type' => 'text',
            'placeholder' => 'The event speaker',
        ]);

        $this->crud->addField([    // TEXT
            'name' => 'start_time',
            'label' => 'Start Time',
            'type' => 'datetime_picker',
            'datetime_picker_options' => [
                'format' => 'DD/MM/YYYY HH:mm',
                'language' => 'en'
            ]
        ]);

        $this->crud->addField([    // WYSIWYG
            'name' => 'body',
            'label' => 'Body',
            'type' => 'ckeditor',
            'placeholder' => 'Your textarea text here',
        ]);
        $this->crud->addField([    // SELECT
            'label' => 'Ticket Vendor',
            'type' => 'select_from_array',
            'name' => 'ticket_vendor',
            'allows_null' => true,
            'options' => config('events.ticket_vendors'),
            'value' => null,
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'ticket_vendor_id',
            'label' => 'Ticket Vendor ID',
            'type' => 'text',
            'placeholder' => 'The ID from the ticket vendor',
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'meta_description',
            'label' => 'Meta Description',
            'type' => 'text',
            'placeholder' => '',
        ]);

        $this->crud->addField([    // SELECT
            'label' => 'Venue',
            'type' => 'select_from_array',
            'name' => 'venue_id',
            'allows_null' => true,
            'options' => array_pluck(config('events.venues'), 'title', 'id'),
            'value' => null,
        ]);
        $this->crud->addField([    // SELECT
            'label' => 'Status',
            'type' => 'select_from_array',
            'name' => 'status',
            'allows_null' => true,
            'options' => [0 => 'Draft', 1 => 'Published'],
            'value' => 0,
        ]);

        // ------ CRUD COLUMNS
        $this->crud->addColumns(['title', 'speaker']); // add multiple columns, at the end of the stack
        $this->crud->addColumn([
            'name' => 'start_time',
            'label' => 'Start Time',
            'type' => 'datetime',
        ]); // add a single column, at the end of the stack
        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'boolean',
            'options' => [0 => 'Draft', 1 => 'Published'],
        ]);
    }


	public function store(StoreRequest $request)
	{
		return parent::storeCrud();
	}

	public function update(UpdateRequest $request)
	{
		return parent::updateCrud();
	}
}