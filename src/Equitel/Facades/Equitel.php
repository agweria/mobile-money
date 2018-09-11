<?php
namespace Samerior\MobileMoney\Equitel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Equitel
 * @package Samerior\MobileMoney\Equitel\Facades
 */
class Equitel extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'samerior.equitel';
    }
}
