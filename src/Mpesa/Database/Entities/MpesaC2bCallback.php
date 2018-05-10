<?php

namespace Samerior\MobileMoney\Mpesa\Database\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Samerior\MobileMoney\Mpesa\Database\Entities\MpesaC2bCallback
 *
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
 * @property-read mixed $name
 * @mixin \Eloquent
 */
class MpesaC2bCallback extends Model
{
    protected $guarded = [];

    public function getNameAttribute()
    {
        return $this->FirstName . ' ' . $this->MiddleName . ' ' . $this->LastName;
    }
}
