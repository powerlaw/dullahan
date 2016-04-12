<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/2
 * Time: 上午2:43
 */

namespace Powerlaw\Eunomia;

use Vinkla\Base62\Facades\Base62;

abstract class AbstractFlake extends Eunomia{

//    public $epoch = 1430516286208;
    public $epoch = 1458231290393;
//    public $epoch = 0;

    public static $SEQUENCE_BITS = 12;
    public static $WORKER_BITS = 5;
    public static $REGION_BITS = 5;
    public static $TIMESTAMP_BITS = 41;

    public static $SEQUENCE_MAX = 4095;

    const STRATEGY_SIMULATE = 1;
    const STRATEGY_SERVER = 2;

    public $strategy = self::STRATEGY_SIMULATE;



    public function gen()
    {
        switch($this->strategy)
        {
            case self::STRATEGY_SIMULATE :
            default:
                return $this->genBysimulate();
            case self::STRATEGY_SERVER :
                return $this->genByServer();
        }
    }

    protected function genByServer(){
        return '';
    }

    protected function genBySimulate(){
        return '';
    }

    public abstract function parse($value);

    public function base62()
    {
        $value = $this->base62Encode($this->gen(func_get_args()));
        return $value;
    }
    public function base62Encode($value)
    {
        return Base62::encode($value);
    }
    public function base62Decode($value)
    {
        return Base62::decode($value);
    }

}