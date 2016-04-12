<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 16/3/8
 * Time: 下午12:22
 */

namespace App\Utils;

use Storage;

class CurlUtil {
    public static $USER_AGENTS = [
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36",
        "Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B137 Safari/601.1",
        "Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1",
        "Mozilla/5.0 (Linux; U; Android 4.3; en-us; SM-N900T Build/JSS15J) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30",
        "Mozilla/5.0 (Linux; Android 4.2.2; GT-I9505 Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.76 Mobile Safari/537.36",
    ];

    public static $ACCEPT_ENCODING= "gzip, deflate, sdch";

    public $ch = null;
    public $locations = [];

    public function __construct($url = null) {
        $this->ch = curl_init($url);
        $this->normal();
    }
    public function close() {
        curl_close($this->ch);
    }

    public function options($options = []) {
        foreach ($options as $key => $val)
        {
            curl_setopt($this->ch, $key, $val);
        }
    }
    public function normal() {
        $ch = $this->ch;
        curl_setopt($ch, CURLOPT_USERAGENT, static::$USER_AGENTS[0]);
        curl_setopt($ch, CURLOPT_ENCODING, static::$ACCEPT_ENCODING);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, function($ch, &$header) {
            $key = 'Location:';
            if (strpos($header, $key) === 0) {
                $this->locations[] = trim(substr($header, strlen($key)));
            }
            return strlen($header);
        });
        curl_setopt($ch, CURLOPT_MAXREDIRS,20);
        curl_setopt($ch, CURLOPT_HEADER,true);
        curl_setopt($ch, CURLINFO_HEADER_OUT,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        curl_setopt($ch, CURLOPT_COOKIEFILE, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, storage_path()."/cookie/cookies.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE, storage_path()."/cookie/cookies.txt");


        //        curl_setopt($ch,CURLOPT_NOPROGRESS, 1);
        //        curl_setopt($ch,CURLOPT_NOBODY, 0);
        //        curl_setopt($ch,CURLOPT_HTTPGET, 1);
        return $ch;
    }

    public function exec($part = null) {
        $ch = $this->ch;
        $response = curl_exec($ch);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $totalTime = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
        $locations = $this->locations;
        if (count($locations)>0 && strpos($locations[count($locations)-1],"sec.taobao.com") !== false) {
//            file_put_contents(storage_path()."/cookie.jar",'');
            Storage::disk('cookie')->put('cookies.txt','');
        }
        if (is_array($part) && !empty($part)){
            return compact($part);
        }else {
            return $body;
        }
    }

    public static function randomIp(){
        $ip_long = array(
            array('607649792', '608174079'), //36.56.0.0-36.63.255.255
            array('1038614528', '1039007743'), //61.232.0.0-61.237.255.255
            array('1783627776', '1784676351'), //106.80.0.0-106.95.255.255
            array('2035023872', '2035154943'), //121.76.0.0-121.77.255.255
            array('2078801920', '2079064063'), //123.232.0.0-123.235.255.255
            array('-1950089216', '-1948778497'), //139.196.0.0-139.215.255.255
            array('-1425539072', '-1425014785'), //171.8.0.0-171.15.255.255
            array('-1236271104', '-1235419137'), //182.80.0.0-182.92.255.255
            array('-770113536', '-768606209'), //210.25.0.0-210.47.255.255
            array('-569376768', '-564133889'), //222.16.0.0-222.95.255.255
        );
        $rand_key = mt_rand(0, 9);
        $ip= long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
        return $ip;
    }

    public static function urldecoding($url, $type = 'UTF-8') {
        if ($type == 'UTF-8') {
            $type2 = 'GBK';
        } else {
            $type = 'GBK';
            $type2 = 'UTF-8';
        }
        $url=urldecode($url);
        $temp1=@iconv($type,$type2,$url);
        $temp2=@iconv($type2,$type,$temp1);
        if ($temp2==$url) {
            return urldecode ( $url );
        } else {
            try {
                $tempdata = iconv ( $type2, $type, urldecode ( $url ) );
            } catch ( \Exception $e ) {
                $tempdata = '';
            }
            return $tempdata;
        }
    }
} 