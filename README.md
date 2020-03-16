# Laravel Menu Architect
[![Total Downloads](https://poser.pugx.org/rc1021/laravel-menu-architect/downloads.svg)](https://packagist.org/packages/rc1021/laravel-menu-architect)
[![License](https://poser.pugx.org/rc1021/laravel-menu-architect/license.svg)](https://packagist.org/packages/rc1021/laravel-menu-architect)


A quick and easy way to build menus in [Laravel](http://laravel.com/)

![Laravel Menu Architect](https://raw.githubusercontent.com/rc1021/laravel-menu-architect/master/screenshot.png)

## Installation

```bash
composer require rc1021/laravel-menu-architect
```

If you are in Laravel 5.5 you won't need to edit your `config/app.php`, if you are in a previous version of Laravel, please do the following:

Append Laravel Menu service provider to `providers` array in `config/app.php`.

```php
'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,

    ...

        Rc1021\LaravelMenuArchitect\LaravelMenuArchitectServiceProvider::class,

        ...

],
```

At the end of `config/app.php` add `'MenuArct'    => Rc1021\LaravelMenuArchitect\Facades\MenuArct::class` to the `$aliases` array:

```php
'aliases' => [

    'App'       => Illuminate\Support\Facades\App::class,
    'Artisan'   => Illuminate\Support\Facades\Artisan::class,
    ...
    'MenuArct'      => Rc1021\LaravelMenuArchitect\Facades\MenuArct::class,

],
```

This registers the package with Laravel and creates an alias called `MenuArct`.


To use your own settings, publish config.
```bash
php artisan vendor:publish --provider="Rc1021\\LaravelMenuArchitect\\LaravelMenuArchitectServiceProvider"
```

## Getting Started

Start up laravel server

```bash
php artisan serve
```

and open [http://127.0.0.1:8000/menu_arct](http://127.0.0.1:8000/menu_arct) get start.

## Demo data (seeder)

You can seeder the database first.
```bash
php artisan db:seed --class=MenuArchitectSeeder
```

Finally, open a view and add:
```php
{!! menu_arct('admin') !!}
```
Your menu will be created and displayed on the page.

## Output data

You can also get menu data format by 'array' or 'json', like that:

```php
$arr_menu = menu_arct('admin', '_array');
$json_menu = menu_arct('admin', '_json');
```

## Output display

![Display Menu](https://raw.githubusercontent.com/rc1021/laravel-menu-architect/master/output_display.png)

## If You Need Help

Please submit all issues and questions using GitHub issues and I will try to help you.


## Contributing

Please feel free to submit pull requests if you can improve or add any features.

## Credits

* [許益銘 rc1021](https://github.com/rc1021)
* [All Contributors](https://github.com/rc1021/laravel-menu-architect/graphs/contributors)

## License

*Laravel Menu Architect* is free software distributed under the terms of the MIT license.
