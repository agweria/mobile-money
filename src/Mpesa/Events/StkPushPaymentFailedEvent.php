<?php

namespace Samerior\MobileMoney\Mpesa\Events;

use Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkCallback;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class StkPushPaymentFailedEvent
 * @package Samerior\MobileMoney\Events
 */
class StkPushPaymentFailedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var MpesaStkCallback
     */
    public $stk_callback;
    /**
     * @var array
     */
    public $mpesa_response;

    /**
     * StkPushPaymentSuccessEvent constructor.
     * @param MpesaStkCallback $stkCallback
     * @param array $response
     */
    public function __construct(MpesaStkCallback $stkCallback, array $response = [])
    {
        $this->stk_callback = $stkCallback;
        $this->mpesa_response = $response;
    }
}
