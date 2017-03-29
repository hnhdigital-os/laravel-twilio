<?php

namespace Bluora\LaravelTwilio;

use Illuminate\Support\Facades\Facade as BaseFacade;

class SmsFacade extends BaseFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Sms';
    }
}
