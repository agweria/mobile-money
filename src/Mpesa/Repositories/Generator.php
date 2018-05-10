<?php

namespace Samerior\MobileMoney\Mpesa\Repositories;

use Samerior\MobileMoney\Mpesa\Exceptions\MpesaException;

/**
 * Class Generator
 * @package Samerior\MobileMoney\Repositories
 */
class Generator
{
    /**
     * Generate a random transaction number
     *
     * @return string
     */
    public static function generateTransactionNumber(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = \strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 15; $i++) {
            $randomString .= $characters[\random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param string $initiatorPass
     * @return string
     * @throws MpesaException
     */
    public static function computeSecurityCredential($initiatorPass): string
    {
        if (\config('samerior.mpesa.sandbox')) {
            $pubKeyFile = __DIR__ . '/../Support/sandbox.cer';
        } else {
            $pubKeyFile = __DIR__ . '/../Support/production.cer';
        }
        if (\is_file($pubKeyFile)) {
            $pubKey = file_get_contents($pubKeyFile);
        } else {
            throw new MpesaException('Please provide a valid public key file');
        }
        openssl_public_encrypt($initiatorPass, $encrypted, $pubKey, OPENSSL_PKCS1_PADDING);
        return base64_encode($encrypted);
    }
}
