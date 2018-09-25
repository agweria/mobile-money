<?php

namespace Samerior\MobileMoney\Mpesa\Database\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentRequest
 *
 * @property int $id
 * @property string $conversation_id
 * @property string $originator_conversation_id
 * @property float $amount
 * @property string $phone
 * @property string|null $remarks
 * @property string $CommandID
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse $response
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentRequest whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentRequest whereCommandID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentRequest whereConversationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentRequest whereOriginatorConversationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentRequest wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentRequest whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentRequest whereUserId($value)
 * @mixin \Eloquent
 */
class MpesaBulkPaymentRequest extends Model
{
    protected $guarded = [];

    public function response()
    {
        return $this->hasOne(MpesaBulkPaymentResponse::class, 'ConversationID', 'conversion_id');
    }
}
