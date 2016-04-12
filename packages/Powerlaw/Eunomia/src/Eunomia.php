<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/4/27
 * Time: 下午11:54
 */

namespace Powerlaw\Eunomia;

use Powerlaw\Eunomia\Contracts\IDGenerable;

class Eunomia implements IDGenerable {
    const SNOWFLAKE = 'snowflake';
    const SIMPLEFLAKE = 'simpleflake';
    const UUID = 'uuid';
    const GUID = 'guid';


    private $defaultAlgorithm = self::SNOWFLAKE;

    private $classes = [];
    private $generators = [];
    private $options = [];

    function __construct($defaultAlgorithm=self::SNOWFLAKE)
    {
        $this->defaultAlgorithm = $defaultAlgorithm;
        $this->classes = [
            self::SNOWFLAKE => __NAMESPACE__.'\SnowFlake',
            self::SIMPLEFLAKE => __NAMESPACE__.'\SimpleFlake',
            self::UUID => __NAMESPACE__.'\UUID',
            self::GUID => __NAMESPACE__.'\UUID',
        ];
    }
    public function getClasses()
    {
        return $this->classes;
    }
    public function getClassName($key)
    {
        return $this->classes[$key];
    }

    private function buildGenerator($type)
    {
        $class = $this->classes[$type];
        $this->generators[$type] = new $class;
    }

    public function getTimestamp($micro=true)
    {
        if ($micro){
            return intval(round(microtime(true)*1000));
        }
        return time();
    }

    function __call($method, $parameters)
    {
        $generatorName = $method;
        if (!isset($this->generators[$generatorName])){
            $this->buildGenerator($method);
        }
        $generator = $this->generators[$generatorName];
        return call_user_func_array(array($generator, 'gen'), $parameters);
    }

    public function gen()
    {
        return $this->__call($this->defaultAlgorithm,func_get_args());
    }
}