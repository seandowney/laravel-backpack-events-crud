# SeanDowney\BackpackEventsCrud

[![Latest Version on Packagist][ico-version]](link-packagist)
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

An admin interface to easily add/edit/remove Events, using [Laravel Backpack](laravelbackpack.com).

## Install

1) In your terminal:

``` bash
$ composer require seandowney/backpackeventscrud
```

2) Add the service provider to your config/app.php file:
```php
SeanDowney\BackpackEventsCrud\EventsCRUDServiceProvider::class,
```

3) Publish the config file & run the migrations
```bash
$ php artisan vendor:publish --provider="SeanDowney\BackpackEventsCrud\EventsCRUDServiceProvider" #publish config, view  and migration files
$ php artisan migrate #create the events tabl
```

4) [Optional] Add a menu item for it in resources/views/vendor/backpack/base/inc/sidebar.blade.php or menu.blade.php:

```html
<li class="treeview">
  <a href="#"><i class="fa fa-group"></i> <span>Events</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
	<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/event') }}"><i class="fa fa-file-o"></i> <span>Events</span></a></li>
	<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/venue') }}"><i class="fa fa-file-o"></i> <span>Venues</span></a></li>
  </ul>
</li>
```

## Usage Guide

### Front End

```php
Route::get('events', ['uses' => '\SeanDowney\BackpackEventsCrud\app\Http\Controllers\EventController@index']);
Route::get('events/{event}/{subs?}', ['as' => 'view-event', 'uses' => '\SeanDowney\BackpackEventsCrud\app\Http\Controllers\EventController@view'])
    ->where(['event' => '^((?!admin).)*$', 'subs' => '.*']);
```

You can use your own Frontend Controller and routes instead of the base routes.

There are base views with the package which can be modified in your own code by adding your own to ``/resources/views/vendor/seandowney/eventscrud/``.

In the Event model there are a few helpful methods (next, upcoming, prev) which can be used in a View Composer
Eg
```php
View::composer('_partials.sidebar', function ($view) use ($events) {
    $view->with('events', $events->upcoming());
    $view->with('ticket_vendors', config('seandowney.eventscrud.ticket_vendors'));
});
```

### Config
Ticket Vendors can be edited in the ``config/seandowney/eventscrud.php``

Ticket Vendors are used to display the registration form on the front end.  Eg Choose Eventbrite, add the Eventbrite event id to the backend field and then on the Frontend an Eventbrite form is displayed to allow the users to register for tickets using Eventbrite.

You can add other vendors yourself by adding more views to ``/resources/views/vendor/seandowney/eventscrud/ticket_vendors/``


The package is not intended to be a complete replacement for Eventbrite or similar services.

The frontend provided is just a starting point and will not be developed further.


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Testing

``` bash
// TODO
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email sean@considerweb.com instead of using the issue tracker.

## Credits

- Seán Downey - Lead Developer
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/seandowney/backpackeventscrud.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/seandowney/backpackeventscrud.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/seandowney/backpackeventscrud
[link-downloads]: https://packagist.org/packages/seandowney/backpackeventscrud
[link-contributors]: ../../contributors
