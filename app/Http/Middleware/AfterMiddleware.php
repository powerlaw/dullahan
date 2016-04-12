<?php

namespace App\Http\Middleware;
use Illuminate\Http\JsonResponse;

use Closure;
use Config;
use Logger;
use Helper;
use Header;

class AfterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if ($response instanceof JsonResponse)
        {
            $ret = $response->getData(true);
            $ret['header'][Header::API_VERSION] = $request->header(Header::API_VERSION,'');
            foreach($ret['header'] as $key => $val)
            {
                $response->header($key,$val);
            }
            $ret['params'] = $request->all();
            empty($ret['params']) && $ret['params'] = (object)null;
            empty($ret['data']) && $ret['data'] = (object)null;
            empty($ret['errors']) && $ret['errors'] = (object)null;
            $response->setData($ret);
        }

        if (method_exists($response,"header")){
            $response->header('Content-Type',rtrim($response->headers->get('Content-Type'),';').';charset=utf-8');
        }
        return $response;
    }

    public function terminate($request, $response)
    {
        global $appStartTime;
        $time = round((microtime(true)-$appStartTime)*1000,4);
        $method = $request->getMethod();
        $headers = $request->header();
        array_walk($headers,function(&$val){
            $val = $val[0];
        });
        $param = $request->all();
        $segments = $request->segments();
        $ip = $request->ip();
        $cookie = $request->cookie();
        $url = $request->fullUrl();
        $httpcode = $response->getStatusCode();

        Config::get('livius.request.enable',true) && Logger::request($url, compact('method','time','param','ip','headers','segments','cookie','httpcode'));
        Config::get('livius.curl.enable',true) &&  Logger::curl(Helper::cmd()->curl($method,$request->url(),$param,$headers));
        Config::get('livius.response.enable',true) && Logger::response($response->getContent(),compact('url','time','httpcode'));

    }
}
