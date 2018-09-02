<?php

namespace Alive2212\LaravelWalletService;

use Illuminate\Contracts\Routing\Registrar as Router;

class RouteRegistrar
{
    /**
     * The router implementation.
     *
     * @var \Illuminate\Contracts\Routing\Registrar
     */
    protected $router;

    /**
     * Create a new route registrar instance.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Register routes for transient tokens, clients, and personal access tokens.
     *
     * @return void
     */
    public function all()
    {
        $this->forRestfulRoute();
        $this->forCustomRoute();
    }

    /**
     * Register the routes needed for authorization.
     *
     * @return void
     */
    public function forRestfulRoute()
    {
        $this->router->group([
            'prefix' => config('laravel-wallet-service.route.restful_prefix'),
        ], function (Router $router) {
            $router->resource('/wallet/base', 'AliveWalletBaseController');
            $router->resource('/wallet/payment', 'AliveWalletPaymentController');
            $router->resource('/wallet/stuff', 'AliveWalletStuffController');
        });
    }

    /**
     *
     */
    public function forCustomRoute()
    {
        $this->router->group([
            'prefix' => config('laravel-mobile-passport.route.custom_prefix'),
        ], function (Router $router) {
            $router->get(
                '/wallet/balance',
                'CustomWalletController@balance'
            )->name('wallet_service.balance');
            $router->get(
                '/wallet/payment_list',
                'CustomWalletController@paymentList'
            )->name('wallet_service.payment_list');
            $router->post(
                '/wallet/credit',
                'CustomWalletController@credit'
            )->name('wallet_service.credit');
            $router->post(
                '/wallet/debit',
                'CustomWalletController@debit'
            )->name('wallet_service.debit');
        });
    }
}
