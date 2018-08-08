<?php

namespace Alive2212\LaravelWalletService\Http\Controllers;

use Alive2212\LaravelSmartRestful\BaseController;
use Alive2212\LaravelTicketService\AliveTicket;

class AliveWalletStuffController extends BaseController
{
    protected $localPrefix = 'laravel-wallet-service';

    /**
     *
     */
    public function initController()
    {
        $this->model = new AliveTicket();
        $this->middleware([
            'auth:api',
        ]);
    }
}