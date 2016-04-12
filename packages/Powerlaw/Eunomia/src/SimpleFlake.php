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

class SimpleFlake extends AbstractFlake {

    public static $SEQUENCE_BITS = 22;
    public static $TIMESTAMP_BITS = 41;

    public static $SEQUENCE_MAX = 4194303;

    const STRATEGY_SIMULATE = 1;
    const STRATEGY_SERVER = 2;

    public $strategy = self::STRATEGY_SIMULATE;

    function __construct()
    {
        $this->strategy = Config::get('eunomia.simple.strategy',$this->strategy);
    }

    protected function genBySimulate()
    {
        $timestamp = $this->getTimestamp();
        $epoch = $this->getEpoch();
        $timestamp -=$epoch;

        $sequence = $this->getSequence();

        $timestampShift = $this->getTimestampShift();

        $value = ($timestamp << $timestampShift) | $sequence;
        return $value;
    }

    public function parse($value)
    {
        $timestampShift = $this->getTimestampShift();
        $epoch = $this->getEpoch();

        $sequence = ($value) & ~(-1 << self::$SEQUENCE_BITS);
        $timestamp = ($value >> $timestampShift) & ~(-1 << self::$TIMESTAMP_BITS);
        $timestamp += $epoch;

        return compact('timestamp','sequence');
    }

    public function parseTimestamp($value)
    {
        $this->parse($value)['timestamp'];
    }
    public function parseSequence($value)
    {
        $this->parse($value)['sequence'];
    }
    private function getTimestampShift()
    {
        return self::$SEQUENCE_BITS;
    }
    private function getSequence()
    {
        return mt_rand(0,self::$SEQUENCE_MAX);
    }
    private function getEpoch()
    {
        return Config::get(ID::SIMPLEFLAKE.".epoch",$this->epoch);
    }
}