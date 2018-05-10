### Register C2B Callback Url

You need to register C2B callbacks to get Instant Payment Notifications when a payment is successfully made to your shortcode.

This happens for till numbers and paybill number (Both Stk initiated and customer initiated payment)

::: tip Use HTTPS
Please use https. You will get weird errors if use non secure URL's for callback.
You can get a free ssl certificate from [Let's Encrypt](https://letsencrypt.org/)
:::
If you have setup `env('APP_URL)` in your ``.env`` you can used predefined endpoints in your published config file.
There are routes already registered to handle the incoming request.
```bash
php artisan mpesa:register_url
```
This will prompt you for the endpoints and send the for registration
