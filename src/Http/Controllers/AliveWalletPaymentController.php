<?php

namespace Alive2212\LaravelWalletService\Http\Controllers;

use Alive2212\LaravelSmartRestful\BaseController;
use Alive2212\LaravelWalletService\AliveWalletPayment;

class AliveWalletPaymentController extends BaseController
{
    /**
     * @var string
     */
    protected $localPrefix = 'laravel-wallet-payment';

    protected $indexLoad = [
        'author',
        'from',
        'to',
        'for'
    ];

    /**
     *
     */
    public function initController()
    {
        $this->model = new AliveWalletPayment();
        $this->middleware([
            'auth:api',
        ]);
    }
}