<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/3
 * Time: 上午2:20
 */

namespace Powerlaw\Dullahan;

class Dullahan {
    const ACCEPT = 'Accept';
    const ACCEPT_ENCODING = 'Accept-encoding';
    const ACCEPT_LANGUAGE = 'Accept-Language';
    const CACHE_CONTROL = 'Cache-Control';
    const CONNECTION = 'Connection';
    const COOKIE = 'Cookie';
    const HOST = 'Host';
    const PRAGMA = 'Pragma';
    const REFERER = 'Referer';
    const UPGRADE_INSECURE_REQUESTS = 'Upgrade-Insecure-Requests';
    const USER_AGENT = 'User-Agent';

    const CONTENT_ENCODING = 'Content-Encoding';
    const CONTENT_TYPE = 'Content-Type';
    const DATE = 'Date';
    const SERVER = 'Server';
    const SET_COOKIE = 'Set-Cookie';
    const TRANSFER_ENCODING = 'chunked';
    const API_VERSION = 'X-API-Version';
    const TOTAL_COUNT = 'X-Total-Count';
    const CURRENT_COUNT = 'X-Current-Count';
    const LINK = 'Link';

    /**
     * Accept Value Example
     * application/vnd.github.v3+json
     * application/vnd.github.v3.raw+json
     * application/vnd.github.v3.full+json
     */
    //text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8
    //'application/json',
    private $headers = [
        self::ACCEPT=>'*/*',
        self::API_VERSION=>'1.0',
        self::TOTAL_COUNT => 'X-Total-Count',
        self::CURRENT_COUNT => 'X-Current-Count',
        self::LINK => 'Link',

        self::COOKIE => '',
        self::PRAGMA => 'no-cache',
        self::REFERER => '',
        self::CONTENT_ENCODING => 'gzip',
        self::CONTENT_TYPE => 'application/json',
        self::SET_COOKIE => '',
        self::TRANSFER_ENCODING => 'chunked',
    ];

    function __construct($headers=[])
    {
        $this->headers = array_merge($this->headers,$headers);

        $this->headers[self::DATE] = date('r');
        $this->headers[self::HOST] = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
        $this->headers[self::SET_COOKIE] = cookie();
        $this->headers[self::SERVER] = isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '';
        $this->headers[self::ACCEPT_LANGUAGE] = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : 'zh-CN,zh;q=0.8';
        $this->headers[self::ACCEPT_ENCODING] = isset($_SERVER['HTTP_ACCEPT_ENCODING']) ? $_SERVER['HTTP_ACCEPT_ENCODING'] : 'gzip, deflate, sdch';
        $this->headers[self::USER_AGENT] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $this->headers[self::UPGRADE_INSECURE_REQUESTS] = isset($_SERVER['HTTP_UPGRADE_INSECURE_REQUESTS']) ? $_SERVER['HTTP_UPGRADE_INSECURE_REQUESTS'] : '1';
        $this->headers[self::ACCEPT] = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '*/*';
        $this->headers[self::CACHE_CONTROL] = isset($_SERVER['HTTP_CACHE_CONTROL']) ? $_SERVER['HTTP_CACHE_CONTROL'] : 'max-age=0';
        $this->headers[self::CONNECTION] = isset($_SERVER['HTTP_CONNECTION']) ? $_SERVER['HTTP_CONNECTION'] : 'keep-alive';
    }


    public function getHeaders()
    {
        return $this->headers;
    }
    public function getHeader($key)
    {
        return $this->headers[$key];
    }
    public function page($pager)
    {
        $header = [];
        $header[self::TOTAL_COUNT] = $pager->total();
        $header[self::CURRENT_COUNT] = $pager->count();
        $header[self::LINK] = '<'.$pager->nextPageUrl().'>;rel="next"';
        $header[self::LINK] .= '<'.$pager->lastPage().'>;rel="last"';
        $header[self::LINK] .= '<'.$pager->url(1).'>;rel="first"';
        $header[self::LINK] .= '<'.$pager->previousPageUrl().'>;rel="prev"';
        return $header;
    }
}