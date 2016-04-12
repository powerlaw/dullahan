<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/4
 * Time: 下午3:39
 */

namespace Powerlaw\Livius\Facades;
use Illuminate\Support\Facades\Facade;

class Livius extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'logger';
    }
}