<?php

namespace Samerior\MobileMoney\Mpesa\Database\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest
 *
 * @property int $id
 * @property string $phone
 * @property float $amount
 * @property string $reference
 * @property string $description
 * @property string $status
 * @property int $complete
 * @property string $MerchantRequestID
 * @property string $CheckoutRequestID
 * @property int|null $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkCallback $response
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest whereCheckoutRequestID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest whereComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest whereMerchantRequestID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest whereUserId($value)
 * @mixin \Eloquent
 */
class MpesaStkRequest extends Model
{
    protected $guarded = [];

    public function response()
    {
        return $this->hasOne(MpesaStkCallback::class, 'CheckoutRequestID', 'CheckoutRequestID');
    }
}
