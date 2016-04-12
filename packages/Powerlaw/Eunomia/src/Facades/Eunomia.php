<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/4
 * Time: 下午3:39
 */

namespace Powerlaw\Eunomia\Facades;
use Illuminate\Support\Facades\Facade;
use Powerlaw\Eunomia\Eunomia as Reality;

class Eunomia extends Facade {
    const SNOWFLAKE = Reality::SNOWFLAKE;
    const SIMPLEFLAKE = Reality::SIMPLEFLAKE;
    const UUID =  Reality::UUID;
    const GUID = Reality::GUID;
    protected static function getFacadeAccessor()
    {
        return 'id';
    }
}