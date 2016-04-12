<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/4
 * Time: 下午5:06
 */

namespace Powerlaw\Dullahan\Facades;

use Illuminate\Support\Facades\Facade;
use Powerlaw\Dullahan\Dullahan as Reality;

class Dullahan extends Facade{

    const ACCEPT = Reality::ACCEPT;
    const API_VERSION = Reality::API_VERSION;
    const TOTAL_COUNT = Reality::TOTAL_COUNT;
    const CURRENT_COUNT = Reality::CURRENT_COUNT;
    const LINK = Reality::LINK;

    const ACCEPT_ENCODING = Reality::ACCEPT_ENCODING;
    const ACCEPT_LANGUAGE = Reality::ACCEPT_LANGUAGE;
    const CACHE_CONTROL = Reality::CACHE_CONTROL;
    const CONNECTION = Reality::CONNECTION;
    const COOKIE = Reality::COOKIE;
    const HOST = Reality::HOST;
    const PRAGMA = Reality::PRAGMA;
    const REFERER = Reality::REFERER;
    const UPGRADE_INSECURE_REQUESTS = Reality::UPGRADE_INSECURE_REQUESTS;
    const USER_AGENT = Reality::USER_AGENT;

    const CONTENT_ENCODING = Reality::CONTENT_ENCODING;
    const CONTENT_TYPE = Reality::CONTENT_TYPE;
    const DATE = Reality::DATE;
    const SERVER = Reality::SERVER;
    const SET_COOKIE = Reality::SET_COOKIE;
    const TRANSFER_ENCODING = Reality::TRANSFER_ENCODING;

    protected static function getFacadeAccessor()
    {
        return 'header';
    }

} 