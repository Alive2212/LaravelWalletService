<?php

namespace Alive2212\LaravelWalletService\Listeners;

use Alive2212\LaravelWalletService\AliveWalletPayment;
use Alive2212\LaravelWalletService\Events\AliveWalletPaymentSavingEvent;
use Alive2212\LaravelWalletService\LaravelWalletPaymentSingleton;
use Carbon\Carbon;

class AliveWalletPaymentSavingListener
{
    /**
     * @param AliveWalletPaymentSavingEvent $event
     */
    public function handle(AliveWalletPaymentSavingEvent $event)
    {
        // add payment id
        $event->getModel()['payment_id'] = Carbon::now()->format('YmdHisu').rand(1000,9999);

        $model = $event->getModel();

        // calc balance
        $lastBalance = new AliveWalletPayment();
        $lastBalance = $lastBalance->getLastBalance($model['from'],$model['to']);
        $balance = $this->calcBalance($event->getModel()['amount'],$lastBalance);

        // add balance into model
        $event->getModel()['balance'] = $balance;
    }

    /**
     * @param $amount
     * @param $lastBalance
     * @return mixed
     */
    public function calcBalance($amount,$lastBalance)
    {
        $result = $amount;
        return $result+$lastBalance;
    }
}
