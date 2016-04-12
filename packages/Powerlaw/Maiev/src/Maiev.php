<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/4/27
 * Time: 上午4:26
 */

namespace Powerlaw\Maiev;

class Maiev {
    const OK = 0;
    const ERROR = 10000;
    const PARAM = 20000;
    const LOGIC = 30000;
    const SERVICE = 40000;
    const THIRD = 50000;

    public $messages = [
        self::OK => 'OK',
        self::ERROR => 'ERROR',
        self::PARAM => '参数异常',
        self::LOGIC => '逻辑异常',
        self::SERVICE => '服务异常',
        self::THIRD => '第三方异常',
    ];

    public function getMessages()
    {
        return $this->messages;
    }

    public function getMessage($code)
    {
        return $this->messages[$code];
    }

    public function E($code=self::ERROR,$message='',$errors = null)
    {
        $message = empty($message) && isset($this->messages[$code]) ? $this->messages[$code] : $this->messages[self::ERROR];
        $ret = ['code'=>$code,'message'=>$message,'header'=>(object)null,'errors'=>$errors,'data'=>(object)null];
		return $ret;
    }

    public function R($data=null,$header=null)
	{
        empty($data) && $data = (object)$data;
        empty($header) && $header = (object)$header;
        $code = self::OK;
        $message = $this->messages[self::OK];
        $ret = ['code'=>$code,'message'=>$message,'header'=>$header,'errors'=>(object)null,'data'=>$data];
		return $ret;
	}


    public function D($data)
	{
        $argsnum = func_num_args();

        $args = func_get_args();

        if (is_object($data))
        {
            $data = ['item'=>$data];
        }
        elseif(is_array($data))
        {
            if ($data === array_values($data)){
                $data = ['items'=>$data];
            }else{
                $data = ['item'=>$data];
            }
        }

        if ($argsnum>1)
        {
            for($i=1;$i<$argsnum;$i++)
            {
                if (!empty($args[$i]) && is_array($args[$i]) && $data !== array_values($data))
                {
                    $data = array_merge($data,$args[$i]);
                }

            }
        }

        return $data;
	}
}