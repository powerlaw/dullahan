<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/2
 * Time: 上午2:43
 */

namespace Powerlaw\Eunomia;
use Config;
use ID;


class SnowFlake extends AbstractFlake{

    public static $SEQUENCE_BITS = 12;
    public static $WORKER_BITS = 5;
    public static $REGION_BITS = 5;
    public static $TIMESTAMP_BITS = 41;

    public static $SEQUENCE_MAX = 4095;
    const STRATEGY_SIMULATE = 1;
    const STRATEGY_SERVER = 2;

    public $strategy = self::STRATEGY_SIMULATE;

    function __construct()
    {
        $this->strategy = Config::get('eunomia.snowflake.strategy',$this->strategy);
    }

    protected function genBySimulate()
    {
        $timestamp = $this->getTimestamp();
        $epoch = $this->getEpoch();
        $timestamp -=$epoch;

        $region = $this->getWorkerId();
        $worker = $this->getRegionId();
        $sequence = $this->getSequence();

        $workerShift = $this->getWorkerShift();
        $regionShift = $this->getRegionShift();
        $timestampShift = $this->getTimestampShift();

        $value = ($timestamp << $timestampShift) | ($region << $regionShift) | ($worker << $workerShift) | $sequence;
        return $value;
    }

    public function parse($value)
    {
        $workerShift = $this->getWorkerShift();
        $regionShift = $this->getRegionShift();
        $timestampShift = $this->getTimestampShift();
        $epoch = $this->getEpoch();

        $sequence = ($value) & ~(-1 << self::$SEQUENCE_BITS);
        $worker = ($value >> $workerShift) & ~(-1 << self::$WORKER_BITS);
        $region = ($value >> $regionShift) & ~(-1 << self::$REGION_BITS);
        $timestamp = ($value >> $timestampShift) & ~(-1 << self::$TIMESTAMP_BITS);
        $timestamp += $epoch;

        return compact('timestamp','region','worker','sequence');
    }

    public function parseTimestamp($value)
    {
        $this->parse($value)['timestamp'];
    }
    public function parseRegion($value)
    {
        $this->parse($value)['region'];
    }
    public function parseWorker($value)
    {
        $this->parse($value)['worker'];
    }
    public function parseSequence($value)
    {
        $this->parse($value)['sequence'];
    }

    private function getWorkerShift()
    {
        return self::$SEQUENCE_BITS;
    }
    private function getRegionShift()
    {
        return self::$SEQUENCE_BITS+self::$WORKER_BITS;
    }
    private function getTimestampShift()
    {
        return self::$SEQUENCE_BITS+self::$WORKER_BITS+self::$REGION_BITS;
    }
    private function getRegionId()
    {
        return function_exists('env') ? env('REGION',1) : 1;
    }
    private function getWorkerId()
    {
        return function_exists('env') ? env('WORKER',1) : 1;
    }
    private function getSequence()
    {
        return mt_rand(0,self::$SEQUENCE_MAX);
    }
    private function getEpoch()
    {
        return Config::get('eunomia.'.ID::SNOWFLAKE.".epoch",$this->epoch);
    }
}