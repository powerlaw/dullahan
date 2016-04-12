<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/4
 * Time: 下午1:09
 */

namespace Powerlaw\Livius;

use Exception;

class MutedException extends Exception {
    public static function encapsulate(Exception $e) {
        return new static($e->getMessage(), $e->getCode(), $e);
    }
    public function __construct($message, $code, Exception $previous) {
        parent::__construct($message, $code, $previous);
    }
    public function __toString() {
        $e = $this->getPrevious();
        $class = get_class($e);
        $message = $e->getMessage();
        $file = $e->getFile();
        $line = $e->getLine();
        $string  = "Exception '$class' with message '$message' in $file:$line\n";
        $string .= "Stack trace:";
        $num = 0;
        foreach($e->getTrace() as $segment) {
            $curFile = "[internal function]";
            if (isset($segment["file"]) && isset($segment["line"])) {
                $curFile = $segment["file"] . "(" . $segment["line"] . ")";
            }
            $curClass = "";
            if (isset($segment["class"])) $curClass = $segment["class"] . "->";
            $curFunction = $curClass . $segment["function"];
            $args = $delim = "";
            foreach($segment["args"] as $curArg) {
                if (is_object($curArg)) {
                    $curValue = "[" . get_class($curArg) . "]";
                } else {
                    $curValue = "[" . gettype($curArg) . "]";
                }
                $args .= $delim . $curValue;
                $delim = ", ";
            }
            $string .= "\n#$num $curFile: $curFunction($args)";
            $num++;
        }
        $string .= "\n#$num {main}";
        return $string;
    }

} 