<?php

namespace Samerior\MobileMoney\Mpesa\Database\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp
 *
 * @property int $id
 * @property string $name
 * @property string $short_code
 * @property string|null $company
 * @property string $environment
 * @property string $consumer_key
 * @property string $consumer_secret
 * @property string|null $passkey
 * @property string|null $initiator_name
 * @property string|null $initiator_credentials
 * @property string $type
 * @property int $default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $is_live
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp whereConsumerKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp whereConsumerSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp whereEnvironment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp whereInitiatorCredentials($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp whereInitiatorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp wherePasskey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp whereShortCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MpesaApp extends Model
{
    protected $guarded = ['default'];
    protected $appends = ['is_live'];

    public function getIsLiveAttribute()
    {
        return $this->environment === 'production';
    }
}
