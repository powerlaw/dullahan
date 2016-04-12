<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/6/27
 * Time: 下午2:27
 */

namespace Powerlaw\Soraka;


use phpbrowscap\Exception;

class Taobao {
    public function urlSimba2Aitaobao($url) {
        if (empty($url)) return '';
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        $result = urldecode($query['f']);
        return $result;
    }
    public function htmlSimba2Aitaobao($url) {
        if (empty($url)) return '';
        try {
            $response = \Requests::get($url);
        }catch(\Exception $e) {
            return '';
        }
        $result = $response->body;
        return $result;
    }
    public function urlAitaobao2Click($html) {
        \phpQuery::newDocumentHTML($html);
        $url = pq('.price-wrap > a:last')->attr('href');
        if (empty($url)) return '';
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        $query = ['prepvid'=>$query['pvid'],'extra'=>''] + $query;
        $parts['query'] = http_build_query($query);
        $result = "{$parts['scheme']}://{$parts['host']}{$parts['path']}?{$parts['query']}";
        return $result;
    }
    public function extraUrlByKey($url,$key){
        if (empty($url)) return '';
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        return urldecode($query[$key]);
    }
    public function urlClick2Redirect($url) {
        if (empty($url)) return '';
        $response = \Requests::get($url,[],['follow_redirects'=>false]);
        $headers = $response->headers;
        $location = $headers->getValues('location');
        $url = $location[0];
        $url = $this->extraUrlByKey($url,'tu');

        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        unset($query['s']);
        $query['ref'] = '';
        $parts['query'] = http_build_query($query);
        $url = "{$parts['scheme']}://{$parts['host']}{$parts['path']}?{$parts['query']}";
        return $url;
    }
    public function urlSimba2Purchase($url) {
        if (empty($url)) return '';
        $url = $this->urlSimba2Aitaobao($url);
        $html = $this->htmlSimba2Aitaobao($url);
        $url = $this->urlAitaobao2Click($html);
        $url = $this->urlClick2Redirect($url);
        if (empty($url)) return '';
        for ($i=0;$i<10;$i++){
            $response = \Requests::get(
                $url,
                [],
                [
                    'follow_redirects'=>false,
                    'useragent'=>'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345d Safari/600.1.4',
                ]
            );
            $headers = $response->headers;
            $location = $headers->getValues('location');
            if (empty($location[0])){
                usleep(500000);
            }else{
                return $location[0];
            }
        }
        return '';
    }
    public function metaForSimbaUrl($url) {
        if (empty($url)) return '';
        $url = $this->urlSimba2Purchase($url);
        $url = $this->urlPurchase2Detail($url);
        $result = $this->parseDetailUrl($url);
        return $result;
    }
    public function parseDetailUrl($url) {
        if (empty($url)) return ['url'=>'','source'=>'','id'=>''];
        $parts = parse_url($url);
        $domainSections = explode('.', $parts['host']);
        $domainSections = array_reverse($domainSections);
        $source = isset($domainSections[1]) ? $domainSections[1] : '';
        parse_str($parts['query'], $query);
        $id = isset($query['id']) ? $query['id'] : '';
        return compact('url','source','id');
    }
    public function htmlBySimba($url) {
        if (empty($url)) return '';
        $url = $this->urlSimba2Purchase($url);
        $result = $this->htmlByPurchase($url);
        return $result;
    }
    public function htmlByPurchase($url) {
        if (empty($url)) return '';
        $response = \Requests::get($url,[],['useragent'=>'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345d Safari/600.1.4']);
        return $response->body;
    }
    public function urlPurchase2Detail($url) {
        if (empty($url)) return '';
        for ($i=0;$i<10;$i++){
            $response = \Requests::get($url,[],[
                'follow_redirects'=>false,
                'useragent'=>'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345d Safari/600.1.4'
            ]);
            $headers = $response->headers;
            $location = $headers->getValues('location');
            if (empty($location[0])){
                usleep(500000);
            }else{
                return $location[0];
            }
        }
        return '';
    }
    public function hashByPurchase($url) {
        if (empty($url)) return '';
        $response = \Requests::get($url,[],[
            'follow_redirects'=>false,
            'useragent'=>'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345d Safari/600.1.4'
        ]);
        $headers = $response->headers;
        var_dump($headers);die;
        $location = $headers->getValues('location');
        $detailUrl = $location[0];
        return $urlHash;
    }
}