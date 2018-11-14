<?php

namespace Alive2212\LaravelWalletService\Http\Controllers;

use Alive2212\LaravelSmartRestful\BaseController;
use Alive2212\LaravelWalletService\AliveWalletBase;

class AliveWalletBaseController extends BaseController
{
    /**
     * @var string
     */
    protected $localPrefix = 'laravel-wallet-base';

    /**
     *
     */
    public function initController()
    {
        $this->model = new AliveWalletBase();
        $this->middleware([
            'auth:api',
        ]);

    }
}