<?php

namespace Samerior\MobileMoney\Mpesa\Database\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse
 *
 * @property int $id
 * @property int $ResultType
 * @property int $ResultCode
 * @property string $ResultDesc
 * @property string $OriginatorConversationID
 * @property string $ConversationID
 * @property string $TransactionID
 * @property string|null $ResultParameters
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentRequest $request
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse whereConversationID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse whereOriginatorConversationID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse whereResultCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse whereResultDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse whereResultParameters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse whereResultType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse whereTransactionID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MpesaBulkPaymentResponse extends Model
{
    protected $guarded = [];

    public function request()
    {
        return $this->belongsTo(MpesaBulkPaymentRequest::class, 'ConversationID', 'conversation_id');
    }
}
