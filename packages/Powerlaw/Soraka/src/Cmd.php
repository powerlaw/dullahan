<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/7
 * Time: 下午1:03
 */

namespace Powerlaw\Soraka;


class Cmd {
    public function curl($method,$url,$params=[],$headers=[],$curlOptions=[],$otherOptions=[])
	{
        $defaultOtherOptions = ['prettify'=>true,'with_header'=>false];
        $otherOptions = array_merge($defaultOtherOptions,$otherOptions);
        $cmdArr = [];
        $cmdArr[] = "curl";
        $cmdArr[] = "-X \"$method\"";
        if ($otherOptions['with_header']){
            foreach($headers as $key=>$val)
            {
                $cmdArr[] = "-H \"$key: $val\"";
            }
        }
        foreach($curlOptions as $key=>$curlOption)
        {
            if (is_array($curlOption)){
                foreach($curlOption as $val)
                {
                    $cmdArr[] = "-$key \"$val\"";
                }
            }
            $cmdArr[] = "-$key \"$curlOption\"";

        }
        $urlInfo = parse_url($url);
        $host = isset($urlInfo['port']) ? $urlInfo['host'].':'.$urlInfo['port'] : $urlInfo['host'];
        $url = $urlInfo['scheme'].'://'.$host;
        isset($urlInfo['path']) && $url .= $urlInfo['path'];
        array_walk($params,function(&$val,$key){
            $val = urlencode($val);
        });
        $query = http_build_query($params);
        isset($urlInfo['query']) && $query = $urlInfo['query'].$query;
        !empty($query) && $url .=  '?'.$query;
        $cmdArr[] .= "\"".$url."\"";
        if ($otherOptions['prettify']){
            $cmdArr[] = "| python -m json.tool";
        }
        $cmd = implode(' ',$cmdArr);
        return $cmd;
	}

} 