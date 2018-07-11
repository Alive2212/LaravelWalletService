<?php

namespace Alive2212\LaravelWalletService\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelWalletService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelwalletservice';
    }
}
