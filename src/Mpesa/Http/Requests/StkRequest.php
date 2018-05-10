<?php
/**
 * Part of the Ignite Platform.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    pesa
 * @version    1.0.0
 * @author     Dervis Group  LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2018, Dervis Group LLC
 * @link       https://dervisgroup.com
 */

namespace Samerior\MobileMoney\Mpesa\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StkRequest
 * @package Samerior\MobileMoney\Mpesa\Http\Requests
 */
class StkRequest extends FormRequest
{
    public function rules()
    {
        return [
            'amount' => 'required|numeric',
            'phone' => 'required',
            'reference' => 'required',
            'description' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }
}
