```
 _________              _   __    _          
|  _   _  |            (_) [  |  (_)         
|_/ | | \_|_   _   __  __   | |  __   .--.   
    | |   [ \ [ \ [  ][  |  | | [  |/ .'`\ \ 
   _| |_   \ \/\ \/ /  | |  | |  | || \__. | 
  |_____|   \__/\__/  [___][___][___]'.__.'  
                                             
```
Provides the Twilio services to Laravel.

[![Latest Stable Version](https://poser.pugx.org/hnhdigital-os/laravel-twilio/v/stable.svg)](https://packagist.org/packages/hnhdigital-os/laravel-twilio) [![Total Downloads](https://poser.pugx.org/hnhdigital-os/laravel-twilio/downloads.svg)](https://packagist.org/packages/hnhdigital-os/laravel-twilio) [![Latest Unstable Version](https://poser.pugx.org/hnhdigital-os/laravel-twilio/v/unstable.svg)](https://packagist.org/packages/hnhdigital-os/laravel-twilio) [![Built for Laravel](https://img.shields.io/badge/Built_for-Laravel-green.svg)](https://laravel.com/) [![License](https://poser.pugx.org/hnhdigital-os/laravel-twilio/license.svg)](https://packagist.org/packages/hnhdigital-os/laravel-twilio)

[![Build Status](https://travis-ci.org/hnhdigital-os/laravel-twilio.svg?branch=master)](https://travis-ci.org/hnhdigital-os/laravel-twilio) [![StyleCI](https://styleci.io/repos/86529240/shield?branch=master)](https://styleci.io/repos/86529240) [![Test Coverage](https://codeclimate.com/github/hnhdigital-os/laravel-twilio/badges/coverage.svg)](https://codeclimate.com/github/hnhdigital-os/laravel-twilio/coverage) [![Issue Count](https://codeclimate.com/github/hnhdigital-os/laravel-twilio/badges/issue_count.svg)](https://codeclimate.com/github/hnhdigital-os/laravel-twilio) [![Code Climate](https://codeclimate.com/github/hnhdigital-os/laravel-twilio/badges/gpa.svg)](https://codeclimate.com/github/hnhdigital-os/laravel-twilio) 

This package has been developed by H&H|Digital, an Australian botique developer. Visit us at [hnh.digital](http://hnh.digital).

![#f03c15](https://placehold.it/15/f03c15/000000?text=+) Currently only implements messaging.

## Install

Via composer:

`$ composer require hnhdigital-os/laravel-twilio`

Enable the facade by editing `config/app.php`:

```php
    'aliases' => [
        ...
        'Sms' => Bluora\LaravelTwilio\SmsFacade::class,
        ...
    ];
```

## Configuration

Config is published to `config/hnhdigital/twilio.php` and the following environment variables can be provided for each service:

### Messaging

Set `TWILIO_MESSAGING_SID` or `TWILIO_MESSAGING_DEFAULT_NUMBER` but not both.

```
TWILIO_ACCOUNT_SID=
TWILIO_ACCOUNT_TOKEN=
TWILIO_MESSAGING_SID=
TWILIO_MESSAGING_DEFAULT_NUMBER=
TWILIO_MESSAGING_STATUS_CALLBACK=
```

## Contributing

Please see [CONTRIBUTING](https://github.com/hnhdigital-os/laravel-twilio/blob/master/CONTRIBUTING.md) for details.

## Credits

* [Rocco Howard](https://github.com/therocis)
* [All Contributors](https://github.com/hnhdigital-os/laravel-twilio/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/hnhdigital-os/laravel-twilio/blob/master/LICENSE) for more information.
