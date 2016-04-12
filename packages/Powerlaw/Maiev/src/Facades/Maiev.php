<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/4
 * Time: 下午3:39
 */

namespace Powerlaw\Maiev\Facades;
use Illuminate\Support\Facades\Facade;
use Powerlaw\Maiev\Maiev as Reality;

class Maiev extends Facade {

    const OK = Reality::OK;
    const ERROR = Reality::ERROR;
    const PARAM = Reality::PARAM;
    const LOGIC = Reality::LOGIC;
    const SERVICE = Reality::SERVICE;
    const THIRD = Reality::THIRD;

    protected static function getFacadeAccessor()
    {
        return 'err';
    }
}