<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/4
 * Time: 下午3:39
 */

namespace Powerlaw\Soraka\Facades;
use Illuminate\Support\Facades\Facade;

class Soraka extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'helper';
    }

}