<?php

namespace Samerior\MobileMoney\Mpesa\Database\Entities;


use Illuminate\Database\Eloquent\Model;

/**
 * Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp
 *
 * @property int $id
 * @property string $name
 * @property string $shortcode
 * @property string $environment
 * @property string $consumer_key
 * @property string $consumer_secret
 * @property string|null $initiator_name
 * @property string|null $initiator_credentials
 * @property string $type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @mixin \Eloquent
 */
class MpesaApp extends Model
{

}