<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/6/27
 * Time: 上午2:55
 */

namespace Powerlaw\Soraka;


class Url {
    public function baseUrl($endWithSlash = false)
    {
        $env = app()->environment();
        $parts = config('api.environments.'.$env);
        $attachPort = $parts['port'] == 80 ? '' : ':'.$parts['port'];
        if ($parts['host']=='ip'){
            $baseUrl = $parts['schema']."://".$parts['ip'].$attachPort;
        }else{
            $baseUrl = $parts['schema']."://".$parts['domain'].$attachPort;
        }
        if ($endWithSlash) $baseUrl .= '/';
        return $baseUrl;
    }

    public function shareUrl($id, $uri='')
    {
        $env = app()->environment();
        $parts = config('api.environments.'.$env);
        $attachPort = $parts['port'] == 80 ? '' : ':'.$parts['port'];
        if ($parts['host']=='ip'){
            $url = $parts['schema']."://".$parts['ip'].$attachPort;
        }else{
            $url = $parts['schema']."://".$parts['share_domain'].$attachPort;
        }
        $url .= '/'.$uri.'/'.$id;
        return $url;
    }
}