# Dowser\BackpackEventsCrud

[![Latest Version on Packagist][ico-version]](link-packagist)
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

An admin interface to easily add/edit/remove Events, using [Laravel Backpack](laravelbackpack.com).

## Install

1) In your terminal:

``` bash
$ composer require dowser/backpackeventscrud
```

2) Add the service provider to your config/app.php file:
```php
Dowser\BackpackEventsCrud\EventsCRUDServiceProvider::class,
```

3) Publish the config file & run the migrations
```bash
$ php artisan vendor:publish --provider="Dowser\BackpackEventsCrud\EventsCRUDServiceProvider" #publish config, view  and migration files
$ php artisan migrate #create the events tabl
```

4) [Optional] Add a menu item for it in resources/views/vendor/backpack/base/inc/sidebar.blade.php or menu.blade.php:

```html
<li><a href="{{ url(config('backpack.base.route_prefix').'/events') }}"><i class="fa fa-file-o"></i> <span>Events</span></a></li>
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Testing

``` bash
// TODO
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email hello@tabacitu.ro instead of using the issue tracker.

## Credits

- Seán Downey - Lead Developer
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/dowser/backpackeventscrud.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/laravel-dowser/backpackeventscrud/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/laravel-dowser/backpackeventscrud.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/laravel-dowser/backpackeventscrud.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/dowser/backpackeventscrud.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/dowser/backpackeventscrud
[link-travis]: https://travis-ci.org/laravel-dowser/backpackeventscrud
[link-scrutinizer]: https://scrutinizer-ci.com/g/laravel-dowser/backpackeventscrud/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/laravel-dowser/backpackeventscrud
[link-downloads]: https://packagist.org/packages/dowser/backpackeventscrud
[link-contributors]: ../../contributors
