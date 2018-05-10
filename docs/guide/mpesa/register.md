### Register C2B Callback Url

> Note: Please use https. You will get weird errors if use non secure URL's for callback

If you have setup `env('APP_URL)` in your ``.env`` you can used predefined endpoints in your published config file.
There are routes already registered to handle the incoming request.
```bash
php artisan mpesa:register_url
```
This will prompt you for the endpoints and send the for registration
