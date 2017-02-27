<?php

namespace SeanDowney\BackpackEventsCrud\app\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use SeanDowney\BackpackEventsCrud\app\Http\Requests\VenueRequest as StoreRequest;
use SeanDowney\BackpackEventsCrud\app\Http\Requests\VenueRequest as UpdateRequest;

class VenueCrudController extends CrudController {

	public function setUp() {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("SeanDowney\BackpackEventsCrud\app\Models\Venue");
        $this->crud->setRoute(config('backpack.base.route_prefix').'/venue');
        $this->crud->setEntityNameStrings('venue', 'venues');

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
        $this->crud->addField([    // WYSIWYG
            'name' => 'description',
            'label' => 'Description',
            'type' => 'ckeditor',
            'placeholder' => 'Your textarea text here',
        ]);
		$this->crud->addField([    // TEXT
            'name' => 'address1',
            'label' => 'Address Line 1',
            'type' => 'text',
            'placeholder' => '',
        ]);

		$this->crud->addField([    // TEXT
            'name' => 'address2',
            'label' => 'Address Line 2',
            'type' => 'text',
            'placeholder' => '',
        ]);

		$this->crud->addField([    // TEXT
            'name' => 'city',
            'label' => 'Town/City',
            'type' => 'text',
            'placeholder' => '',
        ]);

		$this->crud->addField([    // TEXT
            'name' => 'state',
            'label' => 'State',
            'type' => 'text',
            'placeholder' => '',
        ]);

		$this->crud->addField([    // TEXT
            'name' => 'postcode',
            'label' => 'Postcode',
            'type' => 'text',
            'placeholder' => '',
        ]);

		$this->crud->addField([    // TEXT
            'name' => 'country',
            'label' => 'Country',
            'type' => 'text',
            'placeholder' => '',
        ]);

		$this->crud->addField([    // TEXT
            'name' => 'url',
            'label' => 'URL',
            'type' => 'url',
            'placeholder' => '',
        ]);

		$this->crud->addField([    // TEXT
            'name' => 'phone',
            'label' => 'Phone Number',
            'type' => 'text',
            'placeholder' => '',
        ]);

		$this->crud->addField([    // TEXT
            'name' => 'latitude',
            'label' => 'Latitude',
            'type' => 'text',
			'fake' => true,
            'store_in' => 'coordinates',
        ]);

		$this->crud->addField([    // TEXT
            'name' => 'longitude',
            'label' => 'Longitude',
            'type' => 'text',
			'fake' => true,
            'store_in' => 'coordinates',
        ]);

        // ------ CRUD COLUMNS
        $this->crud->addColumns(['title', 'description']); // add multiple columns, at the end of the stack

        $this->crud->orderBy('title', 'desc');
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
