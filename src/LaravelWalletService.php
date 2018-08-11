<?php

namespace Alive2212\LaravelWalletService;

use Carbon\Carbon;

class LaravelWalletService
{
    /**
     * @param $userId
     * @param $amount
     * @param $stuffTitle
     * @param $description
     * @param array $extraValue
     * @param null $authorId
     */
    public function debit($userId, $amount, $stuffTitle, $description, array $extraValue, $authorId = null)
    {
        LaravelWalletPaymentSingleton::setType(
            'debit'
        );

        LaravelWalletPaymentSingleton::setFrom(
            $this->firstOrCreateBase(
                null,
                null,
                LaravelWalletPaymentSingleton::getBaseTitle()
            )
        );

        LaravelWalletPaymentSingleton::setTo(
            $this->firstOrCreateBase($userId, $userId)
        );

        LaravelWalletPaymentSingleton::setFor(
            $this->firstOrCreateStuff($stuffTitle)
        );

        return $this->storePayment($amount, $description, $extraValue, $authorId);
    }

    /**
     * @param $userId
     * @param $amount
     * @param $stuffTitle
     * @param $description
     * @param array $extraValue
     * @param null $authorId
     */
    public function credit($userId, $amount, $stuffTitle, $description, array $extraValue, $authorId = null)
    {
        LaravelWalletPaymentSingleton::setType(
            'credit'
        );

        LaravelWalletPaymentSingleton::setFrom(
            $this->firstOrCreateBase($userId, $userId)
        );

        LaravelWalletPaymentSingleton::setTo(
            $this->firstOrCreateBase(
                null,
                null,
                LaravelWalletPaymentSingleton::getBaseTitle()
            )
        );

        LaravelWalletPaymentSingleton::setFor(
            $this->firstOrCreateStuff($stuffTitle)
        );

        return $this->storePayment($amount, $description, $extraValue, $authorId);
    }

    /**
     * @param $userId
     * @param null $author_id
     * @param string $title
     * @param string $subtitle
     * @param string $description
     * @return AliveWalletBase
     */
    private function firstOrCreateBase($userId, $author_id = null, $title = '', $subtitle = '', $description = '')
    {
        $base = new AliveWalletBase();
        $base = $base->firstOrCreate([
            'user_id' => $userId,
            'revoked' => false,
        ], [
            'author_id' => $author_id,
            'title' => $title,
            'subtitle' => $subtitle,
            'description' => $description,
        ]);
        return $base;
    }

    /**
     * @param string $title
     * @param string $subtitle
     * @param string $description
     * @param null $userId
     * @param null $author_id
     * @return AliveWalletStuff
     */
    private function firstOrCreateStuff($title = '', $subtitle = '', $description = '', $userId = null, $author_id = null)
    {
        $stuff = new AliveWalletStuff();
        $stuff = $stuff->firstOrCreate([
            'title' => $title,
            'revoked' => false,
        ], [
            'author_id' => $author_id,
            'user_id' => $userId,
            'subtitle' => $subtitle,
            'description' => $description,
        ]);
        return $stuff;
    }

    /**
     * @param $amount
     * @param $description
     * @param array $extraValue
     * @param null $author_id
     * @param Carbon|null $expireTime
     */
    private function storePayment($amount, $description, array $extraValue, $author_id = null, Carbon $expireTime = null)
    {
        $payment = new AliveWalletPayment();

        return $payment->create([
            'author_id' => $author_id,
            'from' => LaravelWalletPaymentSingleton::getFrom()['id'],
            'to' => LaravelWalletPaymentSingleton::getTo()['id'],
            'for' => LaravelWalletPaymentSingleton::getFor()['id'],
            'amount' => $amount,
            'description' => $description,
            'extra_value' => json_encode($extraValue),
            'locked' => is_null($expireTime) ? false : true,
        ]);

        // TODO dispatch a job to expire a payment
    }

    /**
     * @param $userId
     * @return int
     */
    public function getUserBalance($userId)
    {
        $walletPayment = new AliveWalletPayment();
        $from = $this->firstOrCreateBase($userId)['id'];
        $to = $this->
        firstOrCreateBase(
            null,
            null,
            LaravelWalletPaymentSingleton::getBaseTitle())['id'];
        return $walletPayment->calcLastBalance($from, $to);
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function getUserPaymentList($userId)
    {
        $walletPayment = new AliveWalletPayment();
        $from = $this->firstOrCreateBase($userId)['id'];
        $to = $this->
        firstOrCreateBase(
            null,
            null,
            LaravelWalletPaymentSingleton::getBaseTitle())['id'];
        return $walletPayment->getPaymentList($from, $to);
    }
}