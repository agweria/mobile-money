<?php

namespace Samerior\MobileMoney\Mpesa\Http\Controllers;

use Samerior\MobileMoney\Mpesa\Events\QueueTimeoutEvent;
use Samerior\MobileMoney\Mpesa\Repositories\Mpesa;
use Illuminate\Http\Request;

/**
 * Class MpesaController
 * @package Samerior\MobileMoney\Http\Controllers
 */
class MpesaController extends Controller
{
    /**
     * @var Mpesa
     */
    private $repository;

    /**
     * MpesaController constructor.
     * @param Mpesa $repository
     */
    public function __construct(Mpesa $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param string|null $initiator
     * @return \Illuminate\Http\JsonResponse
     */
    public function timeout(Request $request, $initiator = null)
    {
        $this->repository->notification('Queue timeout: *' . $initiator . '*');
        event(new QueueTimeoutEvent($request, $initiator));
        return response()->json(
            [
                'ResponseCode' => '00000000',
                'ResponseDesc' => 'success'
            ]
        );
    }

    /**
     * @param string|null $initiator
     * @return \Illuminate\Http\JsonResponse
     */
    public function result($initiator = null)
    {
        $this->repository->notification('Incoming result: *' . $initiator . '*');
        $this->repository->handleResult($initiator);
        return response()->json(
            [
                'ResponseCode' => '00000000',
                'ResponseDesc' => 'success'
            ]
        );
    }

    /**
     * @param string|null $initiator
     * @return \Illuminate\Http\JsonResponse
     */
    public function paymentCallback($initiator)
    {
        $this->repository->notification('Incoming payment callback: *' . $initiator . '*');
        return response()->json(
            [
                'ResponseCode' => '00000000',
                'ResponseDesc' => 'success'
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmation(Request $request)
    {
        $this->repository->notification('MPESA Confirmation: *C2B*', true);
        $this->repository->processConfirmation(json_encode($request->all()));
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'Confirmation received successfully',
        ];
        return response()->json($resp);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function callback()
    {
        $this->repository->notification('MPESA Callback: *C2B*', true);
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'Callback received successfully',
        ];
        return response()->json($resp);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function stkCallback(Request $request)
    {
        $this->repository->notification('MPESA STK Callback: *C2B*', true);
        $this->repository->processStkPushCallback(json_encode($request->Body));
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'STK Callback received successfully',
        ];
        return response()->json($resp);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function validatePayment()
    {
        $this->repository->notification('MPESA Validate Payment URL: *C2B*');
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'Validation passed successfully',
        ];
        return response()->json($resp);
    }
}
