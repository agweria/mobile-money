<?php

namespace Samerior\MobileMoney\Mpesa\Database\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp
 *
 * @property int $id
 * @property string $name
 * @property string $short_code
 * @property string $environment
 * @property string $consumer_key
 * @property string $consumer_secret
 * @property string|null $passkey
 * @property string|null $initiator_name
 * @property string|null $initiator_credentials
 * @property string $type
 * @property int $default
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
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
}
