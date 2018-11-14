<?php

namespace Alive2212\LaravelWalletService\Http\Controllers;

use Alive2212\LaravelSmartRestful\BaseController;
use Alive2212\LaravelWalletService\AliveWalletStuff;

class AliveWalletStuffController extends BaseController
{
    protected $localPrefix = 'laravel-wallet-stuff';

    /**
     *
     */
    public function initController()
    {
        $this->model = new AliveWalletStuff();
        $this->middleware([
            'auth:api',
        ]);
    }
}