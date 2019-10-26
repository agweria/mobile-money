### B2C (Business to Customer) Payment

Use B2C payments to send money to a registered mpesa phone number.
You will need to have a shortcode with some float.

#### Initiate a transaction

To initiate a transaction, invoke the send function as shown below

```php
use \Samerior\MobileMoney\Mpesa\Facades\B2C;

//.. your logic
 /**
     * @param string $number The recipient phone number
     * @param int $amount The amount to send
     * @param string $remarks Any comments/remarks to send
 */
B2C::send($phone,$amount,$description)
```
Or using helper method
```php
mpesa_send('0710101010',10000,'Salary advance')
```

#### Getting responses

You can listen to B2C events in you application. Simply create a listener subscribe to either `B2cPaymentSuccessEvent` or `B2cPaymentFailedEvent`.

Add listeners to your Event Service Provider
```php
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Samerior\MobileMoney\Mpesa\Events\B2cPaymentFailedEvent;
use Samerior\MobileMoney\Mpesa\Events\B2cPaymentSuccessEvent;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
       // other event listeners
        B2cPaymentSuccessEvent::class => [
            MyB2cSuccessListener::class
        ],
        B2cPaymentFailedEvent::class => [
            MyB2cFailLister::class
        ]
    ];
}
```
