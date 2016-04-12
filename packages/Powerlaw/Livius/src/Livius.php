<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/4
 * Time: 上午11:15
 */

namespace Powerlaw\Livius;

//use Monolog\Formatter\LineFormatter;
use Powerlaw\Livius\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger as MonoLogger;
use Config;

class Livius {

    private $loggers = [];
    private $options = [];

    public function __construct()
    {
    }

    private function buildLogger($type,$customOptions = [])
    {
        $defaultOptions = Config::get('livius._default');
        $options = Config::get("livius.$type");
        $options = array_merge(array_merge($defaultOptions,$options),$customOptions);
        $options['processors'] = array_unique($options['processors']);
        $this->options[$type] = $options;
        $logFile = "{$options['path']}/$type.{$options['suffix']}";
        $monolog = new MonoLogger($type);
        $handler = new RotatingFileHandler($logFile, $options['max_files'], $options['level'],$options['bubble'],$options['permission'],$options['use_locking']);
        $handler->setFilenameFormat($options['filename_format'],$options['file_date_format']);
        $formatter = new LineFormatter($options['line_formatter'],$options['line_date_format'],true,true);
        $handler->setFormatter($formatter);
        $monolog->pushHandler($handler, $options['level']);
        foreach($options['processors'] as $processor)
        {
            $monolog->pushProcessor(new $processor);
        }
        $this->loggers[$type] = $monolog;
    }

    function __call($method, $parameters)
    {
        $loggerName = $method;
        if (!isset($this->loggers[$loggerName])){
            $this->buildLogger($loggerName);
        }
        $logger = $this->loggers[$loggerName];
        $method = strtolower($logger::getLevelName(array_get($this->options,"$loggerName.level")));
        return call_user_func_array(array($logger, $method), $parameters);
    }

    function error()
    {
        $parameters = func_get_args();
//        if($parameters[0] instanceof \Exception)
//        {
//            $parameters[0] = MutedException::encapsulate($parameters[0]);
//        }
        $this->__call('error',$parameters);
    }
}