<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/2
 * Time: 上午2:42
 */

namespace Powerlaw\Eunomia;

use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;
use Config;

class UUID extends Eunomia {
    public $leftCurly = '{';
    public $rightCurly = '}';
    public $hyphen = '-';

    public $useCurly = false;
    public $useHyphen = false;
    public $upperCase = true;

    const STRATEGY_UNIQID = 1;
    const STRATEGY_CLIENT = 2;
    const STRATEGY_MYSQL = 3;

//    public $strategy = self::STRATEGY_UNIQID;
    public $strategy = self::STRATEGY_MYSQL;

    function __construct()
    {
        $this->leftCurly = Config::get('eunomia.uuid.left_curly',$this->leftCurly);
        $this->rightCurly = Config::get('eunomia.uuid.right_curly',$this->rightCurly);
        $this->hyphen = Config::get('eunomia.uuid.hyphen',$this->hyphen);
        $this->useCurly = Config::get('eunomia.uuid.use_curly',$this->useCurly);
        $this->useHyphen = Config::get('eunomia.uuid.use_hyphen',$this->useHyphen);
        $this->upperCase = Config::get('eunomia.uuid.upper_case',$this->upperCase);
        $this->strategy = Config::get('eunomia.uuid.strategy',$this->strategy);
        /**
         * Uuid::generate();
         * Uuid::generate(1,'00:11:22:33:44:55');
         * Uuid::generate(3,'test','6ba7b810-9dad-11d1-80b4-00c04fd430c8');
         * Uuid::generate(4);
         * Uuid::generate(5,'test','6ba7b810-9dad-11d1-80b4-00c04fd430c8');
         * $uuid = Uuid::import('d3d29d70-1d25-11e3-8591-034165a3a613');
         * $uuid = Uuid::generate(1);dd($uuid->time);
         * $uuid = Uuid::generate(4);dd($uuid->version);
         */
    }


    public function gen()
    {
        $prefix = func_num_args()>=1 ? func_get_arg(0) : '';
        switch($this->strategy)
        {
            case self::STRATEGY_UNIQID :
            default:
                return $this->genByUniqid($prefix);
            case self::STRATEGY_CLIENT :
                return $this->genByClient($prefix);
            case self::STRATEGY_MYSQL :
                return $this->genByMysql($prefix);
        }
    }

    public function genByUniqid($prefix = '')
    {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid  = substr($chars,0,8) . $this->hyphen;
        $uuid .= substr($chars,8,4) . $this->hyphen;
        $uuid .= substr($chars,12,4) . $this->hyphen;
        $uuid .= substr($chars,16,4) . $this->hyphen;
        $uuid .= substr($chars,20,12);
        return $this->decorate($uuid,$prefix);
    }

    public function genByClient($prefix = '') {
        $uid = uniqid("", true);
        $data = $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        $data .= $_SERVER['SERVER_NAME'];
        $data .= $_SERVER['SERVER_PORT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $chars = hash('ripemd128', $uid . md5($data));
        $uuid  = substr($chars,0,8) . $this->hyphen;
        $uuid .= substr($chars,8,4) . $this->hyphen;
        $uuid .= substr($chars,12,4) . $this->hyphen;
        $uuid .= substr($chars,16,4) . $this->hyphen;
        $uuid .= substr($chars,20,12);
        return $this->decorate($uuid,$prefix);
    }

    public function genByMysql($prefix = '') {
        $uuid = DB::select('select uuid() as uuid')[0]['uuid'];
        return $this->decorate($uuid,$prefix);
    }

    private function decorate($value,$prefix='')
    {
        if($this->useHyphen==false){
            $value = str_replace($this->hyphen,'',$value);
        }
        if($this->useCurly) {
            $value = $this->leftCurly.$value.$this->rightCurly;
        }
        if($this->upperCase) {
            $value = strtoupper($value);
        }
        $value = $prefix.$value;
        return $value;
    }

}