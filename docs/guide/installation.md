## Installation

Via Composer

``` bash
$ composer require samerior/mobile-money
```

This package does not require you to register any service providers or aliases.

First, publish configuration files
```bash
php artisan vendor:publish --provider="Samerior\MobileMoney\Mpesa\MpesaServiceProvider"
```
This will publish the mpesa configuration file into the `config` directory as
`dervisgroup.mpesa.php`. 
This file contains all the configurations required to use the package. 

::: tip 
Go to [Safaricom Developer Portal](https://developer.safaricom.co.ke) to get app credentials.
:::
If you intend to use Equity Payments run the command below to publish its configuration
```bash
php artisan vendor:publish --provider="Samerior\MobileMoney\Equity\EquityServiceProvider"
```
This will publish the mpesa configuration file into the `config` directory as
`dervisgroup.equity.php`. 
