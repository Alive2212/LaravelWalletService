<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('api')->group(function () {
    Route::prefix('v1')->group(function () {
        // vendor name
        Route::prefix('alive')->group(function () {
            // package name
            Route::prefix('wallet')->group(function () {
                Route::get('balance', 'Alive2212\LaravelWalletService\Http\Controllers\CustomWalletController@balance')->name('wallet_service.balance');
                Route::get('payment_list', 'Alive2212\LaravelWalletService\Http\Controllers\CustomWalletController@paymentList')->name('wallet_service.payment_list');
                Route::post('credit', 'Alive2212\LaravelWalletService\Http\Controllers\CustomWalletController@credit')->name('wallet_service.credit');
                Route::post('debit', 'Alive2212\LaravelWalletService\Http\Controllers\CustomWalletController@debit')->name('wallet_service.debit');
            });

        });
        // vendor name
        Route::prefix('alive')->group(function () {
            // package name
            Route::prefix('wallet')->group(function () {
                // base
                Route::prefix('base')->group(function () {
                    Route::get('', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletBaseController@index')->name('wallet_service.base.index');
                    Route::get('create', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletBaseController@create')->name('wallet_service.base.create');
                    Route::get('{id}/edit', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletBaseController@edit')->name('wallet_service.base.edit');
                    Route::get('{id}', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletBaseController@show')->name('wallet_service.base.show');
                    Route::post('', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletBaseController@store')->name('wallet_service.base.store');
                    Route::put('{id}', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletBaseController@update')->name('wallet_service.base.put');
                    Route::patch('{id}', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletBaseController@update')->name('wallet_service.base.patch');
                    Route::delete('{id}', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletBaseController@destroy')->name('wallet_service.base.destroy');
                });

                // payment
                Route::prefix('payment')->group(function () {
                    Route::get('', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletPaymentController@index')->name('wallet_service.payment.index');
                    Route::get('create', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletPaymentController@create')->name('wallet_service.payment.create');
                    Route::get('{id}/edit', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletPaymentController@edit')->name('wallet_service.payment.edit');
                    Route::get('{id}', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletPaymentController@show')->name('wallet_service.payment.show');
                    Route::post('', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletPaymentController@store')->name('wallet_service.payment.store');
                    Route::put('{id}', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletPaymentController@update')->name('wallet_service.payment.put');
                    Route::patch('{id}', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletPaymentController@update')->name('wallet_service.payment.patch');
                    Route::delete('{id}', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletPaymentController@destroy')->name('wallet_service.payment.destroy');
                });

                // stuff
                Route::prefix('stuff')->group(function () {
                    Route::get('', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletStuffController@index')->name('wallet_service.stuff.index');
                    Route::get('create', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletStuffController@create')->name('wallet_service.stuff.create');
                    Route::get('{id}/edit', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletStuffController@edit')->name('wallet_service.stuff.edit');
                    Route::get('{id}', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletStuffController@show')->name('wallet_service.stuff.show');
                    Route::post('', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletStuffController@store')->name('wallet_service.stuff.store');
                    Route::put('{id}', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletStuffController@update')->name('wallet_service.stuff.put');
                    Route::patch('{id}', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletStuffController@update')->name('wallet_service.stuff.patch');
                    Route::delete('{id}', 'Alive2212\LaravelWalletService\Http\Controllers\AliveWalletStuffController@destroy')->name('wallet_service.stuff.destroy');
                });

            });
        });
    });
});

