<?php

namespace Alive2212\LaravelWalletService\Http\Controllers;

use Alive2212\LaravelSmartRestful\BaseController;
use Alive2212\LaravelTicketService\AliveTicket;

class AliveWalletBaseController extends BaseController
{
    /**
     *
     */
    public function initController()
    {
        $this->model = new AliveTicket();
    }
}