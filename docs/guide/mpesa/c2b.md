### C2B (Customer to Business) Confirmation

The C2B Confirmation is sent to registered URL's above, 

This confirmation is sent for both STK Push payment and User Initiated Payment.

_(Normal paybill number > Account Number > Amount > PIN or Till Number > Amount  > PIN)_

You can get the payment payload in the event handler like above ...

#### Confirmation Payload

The confirmation event exposes the payment details as a model `Samerior\MobileMoney\Mpesa\Database\Entities\MpesaC2bCallback`.
Check properties below.

```
 * @property int $id
 * @property string $TransactionType
 * @property string $TransID
 * @property string $TransTime
 * @property float $TransAmount
 * @property int $BusinessShortCode
 * @property string $BillRefNumber
 * @property string|null $InvoiceNumber
 * @property string|null $ThirdPartyTransID
 * @property float $OrgAccountBalance
 * @property string $MSISDN
 * @property string|null $FirstName
 * @property string|null $MiddleName
 * @property string|null $LastName
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
```

Also check the c2b events for declarative response
