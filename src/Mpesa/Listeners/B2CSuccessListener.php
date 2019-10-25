<?php


namespace Samerior\MobileMoney\src\Mpesa\Listeners;

use Samerior\MobileMoney\Mpesa\Events\B2cPaymentSuccessEvent;

/**
 * Class B2CSuccessListener
 * @package Samerior\MobileMoney\src\Mpesa\Listeners
 */
class B2CSuccessListener
{
    /**
     * @param B2cPaymentSuccessEvent $event
     */
    public function handle(B2cPaymentSuccessEvent $event)
    {
    }
}
