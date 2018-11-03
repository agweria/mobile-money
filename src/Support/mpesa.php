<?php

use Samerior\MobileMoney\Mpesa\Facades\B2C;
use Samerior\MobileMoney\Mpesa\Facades\Identity;
use Samerior\MobileMoney\Mpesa\Facades\STK;
use Samerior\MobileMoney\Mpesa\Library\Simulate;

if (!function_exists('mpesa_balance')) {
    /**
     * @return mixed
     */
    function mpesa_balance()
    {
        return B2C::balance();
    }
}
if (!function_exists('mpesa_send')) {
    /**
     * @param string $phone
     * @param int $amount
     * @param $remarks
     * @return mixed
     */
    function mpesa_send($phone, $amount, $remarks = null)
    {
        return B2C::send($phone, $amount, $remarks);
    }
}
if (!function_exists('mpesa_id_check')) {
    /**
     * @param string $phone
     * @return mixed
     */
    function mpesa_id_check($phone)
    {
        return Identity::validate($phone);
    }
}
if (!function_exists('mpesa_stk_status')) {
    /**
     * @param int $id
     * @return mixed
     */
    function mpesa_stk_status($id)
    {
        return STK::validate($id);
    }
}
if (!function_exists('mpesa_request')) {
    /**
     * @param string $phone
     * @param int $amount
     * @param string|null $reference
     * @param string|null $description
     * @return mixed
     */
    function mpesa_request($phone, $amount, $reference = null, $description = null)
    {
        return STK::requestAmount($amount)
            ->fromNumber($phone)
            ->toAccount($reference)
            ->usingDescription($description)
            ->push();
    }
}
if (!function_exists('mpesa_validate')) {
    /**
     * @param string|int $id
     * @return mixed
     */
    function mpesa_validate($id)
    {
        return STK::validate($id);
    }
}
if (!function_exists('mpesa_simulate')) {
    /**
     * @param int $phone
     * @param string $amount
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Samerior\MobileMoney\Mpesa\Exceptions\MpesaException
     */
    function mpesa_simulate($phone, $amount)
    {
        return app(Simulate::class)->push($phone, $amount);
    }
}
if (!function_exists('generate_mpesa_security_credential')) {
    /**
     * @param string $password The user password
     * @param bool $production
     * @return string
     */
    function generate_mpesa_security_credential($password, $production = true)
    {
        $encrypted = null;
        $path = $production ? __DIR__ . '/production.cer' : __DIR__ . '/sandbox.cer';
        $key_file = trim(file_get_contents($path));
        openssl_public_encrypt($password, $encrypted, $key_file, OPENSSL_PKCS1_PADDING);
        return base64_encode($encrypted);
    }
}