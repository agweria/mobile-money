<?php

namespace Samerior\MobileMoney\Mpesa\Http\Controllers;

use Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp;

/**
 * Class ApiController
 * @package Samerior\MobileMoney\Mpesa\Http\Controllers
 */
class ApiController extends Controller
{
    public function apps()
    {
        return response()->json(MpesaApp::all());
    }
}
