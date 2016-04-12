<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/10
 * Time: 下午9:29
 */

namespace Powerlaw\Soraka;


class Client {

    const CLIENT_INTERVAL = 9999;
    const FORM_INTERVAL = 99;

    public function isApp($code)
    {
        return self::isIos($code)
            || self::isAndroid($code)
            ;
    }
    public function isWeb($code)
    {
        return ($code >= \Constants::CODE_CLIENT_WEB && $code < (\Constants::CODE_CLIENT_WEB + self::CLIENT_INTERVAL));
    }
    public function isWap($code)
    {
        return ($code >= \Constants::CODE_CLIENT_WAP && $code < (\Constants::CODE_CLIENT_WAP + self::CLIENT_INTERVAL));
    }
    public function isBrowser($code)
    {
        return self::isWeb($code) || self::isWap($code);
    }
    public function isWechat($code)
    {
        return ($code >= \Constants::CODE_CLIENT_WECHAT && $code < (\Constants::CODE_CLIENT_WECHAT + self::CLIENT_INTERVAL));
    }
    public function isMobile($code)
    {
        return self::isIos($code)
            || self::isAndroid($code)
            || self::isWap($code)
            || self::isWechat($code)
            ;
    }
    public function isPhone($code)
    {
        return ($code >= \Constants::CODE_CLIENT_IOS_PHONE && $code < (\Constants::CODE_CLIENT_IOS_PHONE + self::FORM_INTERVAL))
            || ($code >= \Constants::CODE_CLIENT_ANDROID_PHONE && $code < (\Constants::CODE_CLIENT_ANDROID_PHONE + self::FORM_INTERVAL))
            ;
    }
    public function isTablet($code)
    {
        return ($code >= \Constants::CODE_CLIENT_IOS_PAD && $code < (\Constants::CODE_CLIENT_IOS_PAD + self::FORM_INTERVAL))
            || ($code >= \Constants::CODE_CLIENT_ANDROID_TABLET && $code < (\Constants::CODE_CLIENT_ANDROID_TABLET + self::FORM_INTERVAL))
            ;
    }
    public function isWatch($code)
    {
        return ($code >= \Constants::CODE_CLIENT_IOS_WATCH && $code < (\Constants::CODE_CLIENT_IOS_WATCH + self::FORM_INTERVAL))
            || ($code >= \Constants::CODE_CLIENT_ANDROID_WATCH && $code < (\Constants::CODE_CLIENT_ANDROID_WATCH + self::FORM_INTERVAL))
            ;
    }
    public function isGlass($code)
    {
        return ($code >= \Constants::CODE_CLIENT_ANDROID_GLASS && $code < (\Constants::CODE_CLIENT_ANDROID_GLASS + self::FORM_INTERVAL));

    }
    public function isIos($code)
    {
        return ($code >= \Constants::CODE_CLIENT_IOS && $code < (\Constants::CODE_CLIENT_IOS + self::CLIENT_INTERVAL));
    }
    public function isAndroid($code)
    {
        return ($code >= \Constants::CODE_CLIENT_ANDROID && $code < (\Constants::CODE_CLIENT_ANDROID + self::CLIENT_INTERVAL));
    }

} 