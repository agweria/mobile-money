<?php

namespace Samerior\MobileMoney\Mpesa\Http\Controllers;

use Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp;

/**
 * Class AdminController
 * @package Samerior\MobileMoney\Mpesa\Http\Controllers
 */
class AdminController extends Controller
{
    public function apps()
    {
        $apps = MpesaApp::all();
        return view('payments::mpesa.apps', compact('apps'));
    }
}
