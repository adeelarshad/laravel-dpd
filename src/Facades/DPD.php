<?php

namespace Proxi\Dpd\Facades;

use Illuminate\Support\Facades\Facade;

class DPD extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dpd';
    }
}
