<?php


namespace Samerior\MobileMoney\src\Mpesa\Listeners;

use Samerior\MobileMoney\Mpesa\Events\B2cPaymentFailedEvent;

/**
 * Class B2CFailedListener
 * @package Samerior\MobileMoney\src\Mpesa\Listeners
 */
class B2CFailedListener
{
    /**
     * @param B2cPaymentFailedEvent $event
     */
    public function handle(B2cPaymentFailedEvent $event)
    {
    }
}
