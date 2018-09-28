<?php
Route::group([
    'prefix' => 'payments/admin',
    'namespace' => 'Samerior\MobileMoney\Mpesa\Http\Controllers'], function () {
    Route::get('/', 'AdminController@apps');
    Route::get('apps', 'AdminController@apps');
});
Route::group([
    'prefix' => 'payments/api',
    'middleware' => 'pesa.cors',
    'namespace' => 'Samerior\MobileMoney\Mpesa\Http\Controllers'
], function () {
    Route::get('apps', 'ApiController@apps');
});
Route::group([
    'prefix' => 'payments/callbacks',
    'middleware' => 'pesa.cors',
    'namespace' => 'Samerior\MobileMoney\Mpesa\Http\Controllers'
], function () {
    Route::any('validate', 'MpesaController@validatePayment');
    Route::any('confirmation', 'MpesaController@confirmation');
    Route::any('callback', 'MpesaController@callback');
    Route::any('stk_callback', 'MpesaController@stkCallback');
    Route::any('timeout_url/{section?}', 'MpesaController@timeout');
    Route::any('result/{section?}', 'MpesaController@result');
    Route::any('stk_request', 'StkController@initiatePush');
    Route::get('stk_status/{id}', 'StkController@stkStatus');
});
