<?php

namespace Alive2212\LaravelWalletService;

use Alive2212\LaravelWalletService\AliveWalletBase;
use Alive2212\LaravelWalletService\AliveWalletStuff;


/**
 * Created by PhpStorm.
 * User: alive
 * Date: 7/9/18
 * Time: 1:00 AM
 */
class LaravelWalletPaymentSingleton
{
    private static $to;
    private static $from;
    private static $for;
    private static $payment;
    private static $type;
    private static $BaseTitle = "daily";

    /**
     * @return string
     */
    public static function getBaseTitle()
    {
        return self::$BaseTitle;
    }

    /**
     * @param string $BaseTitle
     */
    public static function setBaseTitle($BaseTitle)
    {
        self::$BaseTitle = $BaseTitle;
    }



    /**
     * @return mixed
     */
    public static function getType()
    {
        return self::$type;
    }

    /**
     * @param mixed $type
     */
    public static function setType($type)
    {
        self::$type = $type;
    }

    /**
     * @return mixed
     */
    public static function getPayment()
    {
        if (!isset(self::$payment)) {
            self::$payment = new AliveWalletPayment();
        }
        return self::$payment;
    }

    /**
     * @param mixed $payment
     */
    public static function setPayment($payment)
    {
        self::$payment = $payment;
    }

    /**
     * @return mixed
     */
    public static function getTo()
    {
        if (!isset(self::$to)) {
            self::$to = new AliveWalletBase();
        }
        return self::$to;
    }

    /**
     * @param mixed $to
     */
    public static function setTo(AliveWalletBase $to)
    {
        self::$to = $to;
    }

    /**
     * @return mixed
     */
    public static function getFrom()
    {
        if (!isset(self::$from)) {
            self::$from = new AliveWalletBase();
        }
        return self::$from;
    }

    /**
     * @param mixed $from
     */
    public static function setFrom(AliveWalletBase $from)
    {
        self::$from = $from;
    }

    /**
     * @return mixed
     */
    public static function getFor()
    {
        if (!isset(self::$for)) {
            self::$for = new AliveWalletStuff();
        }
        return self::$for;
    }

    /**
     * @param mixed $for
     */
    public static function setFor(AliveWalletStuff $for)
    {
        self::$for = $for;
    }
}