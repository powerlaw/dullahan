<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/4
 * Time: 下午9:51
 */

namespace Powerlaw\Soraka;


class Soraka {
    private $helpers = [];

    public function instance($name,$parameters=[])
    {
        if (!isset($this->helpers[$name]))
        {
            $class = __NAMESPACE__.'\\'.ucfirst(camel_case($name));
            if (class_exists($class)){
                $this->helpers[$name] = call_user_func_array(
                    [new \ReflectionClass($class), 'newInstance'],
                    $parameters
                );
            }else{
                return $this;
            }
        }
        return $this->helpers[$name];
    }
    public function _()
    {

    }

    function __call($method, $parameters)
    {
        return $this->instance($method,$parameters);
    }
}