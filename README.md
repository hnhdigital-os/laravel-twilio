```
 _________              _   __    _          
|  _   _  |            (_) [  |  (_)         
|_/ | | \_|_   _   __  __   | |  __   .--.   
    | |   [ \ [ \ [  ][  |  | | [  |/ .'`\ \ 
   _| |_   \ \/\ \/ /  | |  | |  | || \__. | 
  |_____|   \__/\__/  [___][___][___]'.__.'  
                                             
```
Provides the Twilio services to Laravel.

[![Latest Stable Version](https://poser.pugx.org/bluora/laravel-twilio/v/stable.svg)](https://packagist.org/packages/bluora/laravel-twilio) [![Total Downloads](https://poser.pugx.org/bluora/laravel-twilio/downloads.svg)](https://packagist.org/packages/bluora/laravel-twilio) [![Latest Unstable Version](https://poser.pugx.org/bluora/laravel-twilio/v/unstable.svg)](https://packagist.org/packages/bluora/laravel-twilio) [![Built for Laravel](https://img.shields.io/badge/Built_for-Laravel-green.svg)](https://laravel.com/) [![License](https://poser.pugx.org/bluora/laravel-twilio/license.svg)](https://packagist.org/packages/bluora/laravel-twilio)

[![Build Status](https://travis-ci.org/bluora/laravel-twilio.svg?branch=master)](https://travis-ci.org/bluora/laravel-twilio) [![StyleCI](https://styleci.io/repos/x/shield?branch=master)](https://styleci.io/repos/x) [![Test Coverage](https://codeclimate.com/github/bluora/laravel-twilio/badges/coverage.svg)](https://codeclimate.com/github/bluora/laravel-twilio/coverage) [![Issue Count](https://codeclimate.com/github/bluora/laravel-twilio/badges/issue_count.svg)](https://codeclimate.com/github/bluora/laravel-twilio) [![Code Climate](https://codeclimate.com/github/bluora/laravel-twilio/badges/gpa.svg)](https://codeclimate.com/github/bluora/laravel-twilio) 

This package has been developed by H&H|Digital, an Australian botique developer. Visit us at [hnh.digital](http://hnh.digital).

## Install

Via composer:

`$ composer require-dev bluora/laravel-twilio ~1.0`

Enable the service provider by editing config/app.php:

```php
    'providers' => [
        ...
        Bluora\LaravelTwilio\ServiceProvider::class,
        ...
    ];
```

Enable the facade by editing config/app.php:

```php
    'aliases' => [
        ...
        'Sms' => Bluora\LaravelTwilio\SmsFacade::class,
        ...
    ];
```

## Contributing

Please see [CONTRIBUTING](https://github.com/bluora/laravel-twilio/blob/master/CONTRIBUTING.md) for details.

## Credits

* [Rocco Howard](https://github.com/therocis)
* [All Contributors](https://github.com/bluora/laravel-twilio/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/bluora/laravel-twilio/blob/master/LICENSE) for more information.
