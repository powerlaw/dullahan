<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/11
 * Time: 上午3:01
 */

namespace App\Http;


class Constants {
    const CODE_ERR_OK      = 0;
    const CODE_ERR_ERROR   = 10000;
    const CODE_ERR_PARAM   = 20000;
    const CODE_ERR_LOGIC   = 30000;
    const CODE_ERR_SERVICE = 40000;
    const CODE_ERR_THIRD   = 50000;
    const CODE_ERR_DEFAULT = self::CODE_ERR_OK;

    const CODE_DEVICE_UNKNOWN   = 0;
    const CODE_DEVICE_PHONE     = 100;
    const CODE_DEVICE_TABLET    = 200;
    const CODE_DEVICE_ULTRABOOK = 300;
    const CODE_DEVICE_NETBOOK   = 400;
    const CODE_DEVICE_NOTEBOOK  = 500;
    const CODE_DEVICE_DESKTOP   = 600;
    const CODE_DEVICE_DEFAULT   = self::CODE_DEVICE_PHONE;

    const CODE_CLIENT_UNKNOWN        = 0;
    const CODE_CLIENT_IOS            = 10000;
    const CODE_CLIENT_IOS_PHONE      = 10100;
    const CODE_CLIENT_IOS_PAD        = 10200;
    const CODE_CLIENT_IOS_WATCH      = 10300;
    const CODE_CLIENT_ANDROID        = 20000;
    const CODE_CLIENT_ANDROID_PHONE  = 20100;
    const CODE_CLIENT_ANDROID_TABLET = 20200;
    const CODE_CLIENT_ANDROID_WATCH  = 20300;
    const CODE_CLIENT_ANDROID_GLASS  = 20400;
    const CODE_CLIENT_WEB            = 30000;
    const CODE_CLIENT_WAP            = 40000;
    const CODE_CLIENT_WECHAT         = 50000;
    const CODE_CLIENT_DEFAULT        = self::CODE_CLIENT_ANDROID_PHONE;

    const CODE_SNS_WECHAT        = 100;
    const CODE_SNS_SINA_WEIBO    = 200;
    const CODE_SNS_TENCENT_WEIBO = 300;
    const CODE_SNS_QQ            = 400;
    const CODE_SNS_RENREN        = 500;
    const CODE_SNS_KAIXIN        = 600;
    const CODE_SNS_BAIDU         = 700;
    const CODE_SNS_QIHOO         = 800;
    const CODE_SNS_GOOGLE        = 900;
    const CODE_SNS_FACEBOOK      = 1000;
    const CODE_SNS_TWITTER       = 1100;
    const CODE_SNS_LINKEDIN      = 1200;
    const CODE_SNS_DEFAULT       = self::CODE_SNS_SINA_WEIBO;

    const SNS_WECHAT        = 'wechat';
    const SNS_SINA_WEIBO    = 'weibo';
    const SNS_TENCENT_WEIBO = 'tweibo';
    const SNS_QQ            = 'qq';
    const SNS_RENREN        = 'renren';
    const SNS_KAIXIN        = 'kaixin';
    const SNS_BAIDU         = 'baidu';
    const SNS_QIHOO         = 'qihoo';
    const SNS_GOOGLE        = 'google';
    const SNS_FACEBOOK      = 'facebook';
    const SNS_TWITTER       = 'twitter';
    const SNS_LINKEDIN      = 'linkedin';

    const CODE_SHARE_SMS            = 100;
    const CODE_SHARE_EMAIL          = 200;
    const CODE_SHARE_WECHAT_MOMENTS = 300;
    const CODE_SHARE_WECHAT_FRIEND  = 301;
    const CODE_SHARE_SINA_WEIBO     = 500;
    const CODE_SHARE_TENCENT_WEIBO  = 600;
    const CODE_SHARE_QQ             = 700;
    const CODE_SHARE_QQ_ZONE        = 701;
    const CODE_SHARE_RENREN         = 800;
    const CODE_SHARE_KAIXIN         = 900;
    const CODE_SHARE_BAIDU_HI       = 1000;
    const CODE_SHARE_GOOGLE_PLUS    = 1100;
    const CODE_SHARE_FACEBOOK       = 1200;
    const CODE_SHARE_TWITTER        = 1300;
    const CODE_SHARE_DEFAULT       = self::SHARE_WECHAT_MOMENTS;

    const SHARE_SMS            = 'sms';
    const SHARE_EMAIL          = 'email';
    const SHARE_WECHAT_MOMENTS = 'wechat_moments';
    const SHARE_WECHAT_FRIEND  = 'wechat_friend';
    const SHARE_SINA_WEIBO     = 'weibo';
    const SHARE_TENCENT_WEIBO  = 'tweibo';
    const SHARE_QQ             = 'qq';
    const SHARE_QQ_ZONE        = 'qzone';
    const SHARE_RENREN         = 'renren';
    const SHARE_KAIXIN         = 'kaixin';
    const SHARE_BAIDU_HI       = 'baidu_hi';
    const SHARE_GOOGLE_PLUS    = 'google+';
    const SHARE_FACEBOOK       = 'facebook';
    const SHARE_TWITTER        = 'twitter';

    const CODE_OS_UNKNOWN = 0;
    const CODE_OS_IOS     = 10000;
    const CODE_OS_ANDROID = 20000;
    const CODE_OS_DEFAULT    = self::CODE_OS_ANDROID;

    const OS_UNKNOWN      = 'unknown';
    const OS_ANDROID      = 'Android';
    const OS_BLACKBERRY   = 'BlackBerry';
    const OS_PALM         = 'Palm';
    const OS_SYMBIAN      = 'Symbian';
    const OS_WINDOSMOBILE = 'WindowsMobile';
    const OS_WINDOSPHONE  = 'WindowsPhone';
    const OS_IOS          = 'iOS';
    const OS_MEEGO        = 'MeeGo';
    const OS_MAEMO        = 'Maemo';
    const OS_JAVA         = 'Java';
    const OS_WEB          = 'webOS';
    const OS_BADA         = 'bada';
    const OS_BREW         = 'BREW';
    const OS_WINDOWS      = 'Windows';
    const OS_WINDOWSNT    = 'Windows NT';
    const OS_MACOSX       = 'Mac OS X';
    const OS_DEBIAN       = 'Debian';
    const OS_UBUNTU       = 'Ubuntu';
    const OS_FEDORA       = 'Fedora';
    const OS_CENTOS       = 'CentOS';
    const OS_OPENSUSE     = 'openSuse';
    const OS_REDHAT       = 'Red Hat';
    const OS_PPC          = 'PPC';
    const OS_OPENBSD      = 'OpenBSD';
    const OS_LINUX        = 'Linux';

    const ROBOT_GOOGLE = 'Googlebot';
    const ROBOT_MSN    = 'MSNBot';
    const ROBOT_BAIDU  = 'Baiduspider';
    const ROBOT_BING   = 'Bing';
    const ROBOT_YAHOO  = 'Yahoo';
    const ROBOT_LYCOS  = 'Lycos';

    const BROWSER_UNKNOWN    = 'unknown';
    const BROWSER_OPERA      = 'Opera';
    const BROWSER_OPERA_MINI = 'Opera Mini';
    const BROWSER_WEBTV      = 'WebTV';
    const BROWSER_IE         = 'Internet Explorer';
    //const BROWSER_IE = 'IE';
    const BROWSER_POCKET_IE          = 'Pocket Internet Explorer';
    const BROWSER_KONQUEROR          = 'Konqueror';
    const BROWSER_ICAB               = 'iCab';
    const BROWSER_OMNIWEB            = 'OmniWeb';
    const BROWSER_FIREBIRD           = 'Firebird';
    const BROWSER_FIREFOX            = 'Firefox';
    const BROWSER_ICEWEASEL          = 'Iceweasel';
    const BROWSER_SHIRETOKO          = 'Shiretoko';
    const BROWSER_MOZILLA            = 'Mozilla';
    const BROWSER_AMAYA              = 'Amaya';
    const BROWSER_LYNX               = 'Lynx';
    const BROWSER_SAFARI             = 'Safari';
    const BROWSER_IPHONE             = 'iPhone';
    const BROWSER_IPOD               = 'iPod';
    const BROWSER_IPAD               = 'iPad';
    const BROWSER_ANDROID            = 'Android';
    const BROWSER_CHROME             = 'Chrome';
    const BROWSER_GOOGLEBOT          = 'GoogleBot';
    const BROWSER_SLURP              = 'Yahoo! Slurp';
    const BROWSER_W3CVALIDATOR       = 'W3C Validator';
    const BROWSER_BLACKBERRY         = 'BlackBerry';
    const BROWSER_ICECAT             = 'IceCat';
    const BROWSER_NOKIA_S60          = 'Nokia S60 OSS Browser';
    const BROWSER_NOKIA              = 'Nokia Browser';
    const BROWSER_MSN                = 'MSN Browser';
    const BROWSER_MSNBOT             = 'MSN Bot';
    const BROWSER_BINGBOT            = 'Bing Bot';
    const BROWSER_NETSCAPE_NAVIGATOR = 'Netscape Navigator';
    const BROWSER_GALEON             = 'Galeon';
    const BROWSER_NETPOSITIVE        = 'NetPositive';
    const BROWSER_PHOENIX            = 'Phoenix';
    const BROWSER_DOLFIN             = 'Dolfin';
    const BROWSER_SKYFIRE            = 'Skyfire';
    const BROWSER_BOLT               = 'Bolt';
    const BROWSER_TEASHARK           = 'TeaShark';
    const BROWSER_BLAZER             = 'Blazer';
    const BROWSER_TIZEN              = 'Tizen';
    const BROWSER_BAIDUBOXAPP        = 'baiduboxapp';
    const BROWSER_BAIDU              = 'baidubrowser';
    const BROWSER_DIIGO              = 'DiigoBrowser';
    const BROWSER_PUFFINR            = 'Puffinr';
    const BROWSER_MERCURY            = 'Mercury';
    const BROWSER_OBIGO              = 'ObigoBrowser';
    const BROWSER_NETFRONT           = 'NetFront';
    const BROWSER_NETSCAPE           = 'Netscape';
    const BROWSER_UC                 = 'UCBrowser';
    const BROWSER_GENERIC            = 'GenericBrowser';

    const DEVICE_PHONE_UNKNOWN    = 'unknown';
    const DEVICE_PHONE_IPHONE     = 'iPhone';
    const DEVICE_PHONE_BLACKBERRY = 'BlackBerry';
    const DEVICE_PHONE_HTC        = 'HTC';
    const DEVICE_PHONE_NEXUS      = 'Nexus';
    const DEVICE_PHONE_DELL       = 'Dell';
    const DEVICE_PHONE_MOTOROLA   = 'Motorola';
    const DEVICE_PHONE_SAMSUNG    = 'Samsung';
    const DEVICE_PHONE_LG         = 'LG';
    const DEVICE_PHONE_SONY       = 'Sony';
    const DEVICE_PHONE_ASUS       = 'Asus';
    const DEVICE_PHONE_MICROMAX   = 'Micromax';
    const DEVICE_PHONE_PALM       = 'Palm';
    const DEVICE_PHONE_VERTU      = 'Vertu';
    const DEVICE_PHONE_PANTECH    = 'Pantech';
    const DEVICE_PHONE_FLY        = 'Fly';
    const DEVICE_PHONE_WIKO       = 'Wiko';
    const DEVICE_PHONE_IMOBILE    = 'iMobile';
    const DEVICE_PHONE_SIMVALLEY  = 'SimValley';
    const DEVICE_PHONE_WOLFGANG   = 'Wolfgang';
    const DEVICE_PHONE_ALCATEL    = 'Alcatel';
    const DEVICE_PHONE_NINTENDO   = 'Nintendo';
    const DEVICE_PHONE_AMOI       = 'Amoi';
    const DEVICE_PHONE_INQ        = 'INQ';
    const DEVICE_PHONE_GENERIC    = 'Generic';

    const DEVICE_TABLET_UNKNOWN     = 'nuknown';
    const DEVICE_TABLET_IPAD        = 'iPad';
    const DEVICE_TABLET_NEXUS       = 'NexusTablet';
    const DEVICE_TABLET_SAMSUNG     = 'SamsungTablet';
    const DEVICE_TABLET_KINDLE      = 'Kindle';
    const DEVICE_TABLET_SURFACE     = 'SurfaceTablet';
    const DEVICE_TABLET_HP          = 'HPTablet';
    const DEVICE_TABLET_ASUS        = 'AsusTablet';
    const DEVICE_TABLET_BLACKBERRY  = 'BlackBerryTablet';
    const DEVICE_TABLET_HTCTABLET   = 'HTCtablet';
    const DEVICE_TABLET_MOTOROLA    = 'MotorolaTablet';
    const DEVICE_TABLET_NOOK        = 'NookTablet';
    const DEVICE_TABLET_ACER        = 'AcerTablet';
    const DEVICE_TABLET_TOSHIBA     = 'ToshibaTablet';
    const DEVICE_TABLET_LG          = 'LGTablet';
    const DEVICE_TABLET_FUJITSU     = 'FujitsuTablet';
    const DEVICE_TABLET_PRESTIGIO   = 'PrestigioTablet';
    const DEVICE_TABLET_LENOVO      = 'LenovoTablet';
    const DEVICE_TABLET_DELL        = 'DellTablet';
    const DEVICE_TABLET_YARVIK      = 'YarvikTablet';
    const DEVICE_TABLET_MEDION      = 'MedionTablet';
    const DEVICE_TABLET_ARNOVA      = 'ArnovaTablet';
    const DEVICE_TABLET_INTENSO     = 'IntensoTablet';
    const DEVICE_TABLET_IRU         = 'IRUTablet';
    const DEVICE_TABLET_MEGAFON     = 'MegafonTablet';
    const DEVICE_TABLET_EBODA       = 'EbodaTablet';
    const DEVICE_TABLET_ALLVIEW     = 'AllViewTablet';
    const DEVICE_TABLET_ARCHOS      = 'ArchosTablet';
    const DEVICE_TABLET_AINOL       = 'AinolTablet';
    const DEVICE_TABLET_SONY        = 'SonyTablet';
    const DEVICE_TABLET_PHILIPS     = 'PhilipsTablet';
    const DEVICE_TABLET_CUBE        = 'CubeTablet';
    const DEVICE_TABLET_COBY        = 'CobyTablet';
    const DEVICE_TABLET_MID         = 'MIDTablet';
    const DEVICE_TABLET_MSI         = 'MSITablet';
    const DEVICE_TABLET_SMIT        = 'SMiTTablet';
    const DEVICE_TABLET_ROCKCHIP    = 'RockChipTablet';
    const DEVICE_TABLET_FLY         = 'FlyTablet';
    const DEVICE_TABLET_BQ          = 'bqTablet';
    const DEVICE_TABLET_HUAWEI      = 'HuaweiTablet';
    const DEVICE_TABLET_NEC         = 'NecTablet';
    const DEVICE_TABLET_PANTECH     = 'PantechTablet';
    const DEVICE_TABLET_BRONCHO     = 'BronchoTablet';
    const DEVICE_TABLET_VERSUS      = 'VersusTablet';
    const DEVICE_TABLET_ZYNC        = 'ZyncTablet';
    const DEVICE_TABLET_POSITIVO    = 'PositivoTablet';
    const DEVICE_TABLET_NABI        = 'NabiTablet';
    const DEVICE_TABLET_KOBO        = 'KoboTablet';
    const DEVICE_TABLET_DANEW       = 'DanewTablet';
    const DEVICE_TABLET_TEXET       = 'TexetTablet';
    const DEVICE_TABLET_PLAYSTATION = 'PlaystationTablet';
    const DEVICE_TABLET_TREKSTOR    = 'TrekstorTablet';
    const DEVICE_TABLET_PYLEAUDIO   = 'PyleAudioTablet';
    const DEVICE_TABLET_ADVAN       = 'AdvanTablet';
    const DEVICE_TABLET_DANYTECH    = 'DanyTechTablet';
    const DEVICE_TABLET_GALAPAD     = 'GalapadTablet';
    const DEVICE_TABLET_MICROMAX    = 'MicromaxTablet';
    const DEVICE_TABLET_KARBONN     = 'KarbonnTablet';
    const DEVICE_TABLET_ALLFINE     = 'AllFineTablet';
    const DEVICE_TABLET_PROSCAN     = 'PROSCANTablet';
    const DEVICE_TABLET_YONES       = 'YONESTablet';
    const DEVICE_TABLET_CHANGJIA    = 'ChangJiaTablet';
    const DEVICE_TABLET_GU          = 'GUTablet';
    const DEVICE_TABLET_POINTOFVIEW = 'PointOfViewTablet';
    const DEVICE_TABLET_OVERMAX     = 'OvermaxTablet';
    const DEVICE_TABLET_HCL         = 'HCLTablet';
    const DEVICE_TABLET_DPS         = 'DPSTablet';
    const DEVICE_TABLET_VISTURE     = 'VistureTablet';
    const DEVICE_TABLET_CRESTA      = 'CrestaTablet';
    const DEVICE_TABLET_MEDIATEK    = 'MediatekTablet';
    const DEVICE_TABLET_CONCORDE    = 'ConcordeTablet';
    const DEVICE_TABLET_GOCLEVER    = 'GoCleverTablet';
    const DEVICE_TABLET_MODECOM     = 'ModecomTablet';
    const DEVICE_TABLET_VONINO      = 'VoninoTablet';
    const DEVICE_TABLET_ECS         = 'ECSTablet';
    const DEVICE_TABLET_STOREX      = 'StorexTablet';
    const DEVICE_TABLET_VODAFONE    = 'VodafoneTabletx';
    const DEVICE_TABLET_ESSENTIELB  = 'EssentielBTablet';
    const DEVICE_TABLET_ROSSMOOR    = 'RossMoorTabletx';
    const DEVICE_TABLET_IMOBILE     = 'iMobileTablet';
    const DEVICE_TABLET_TOLINO      = 'TolinoTablet';
    const DEVICE_TABLET_AUDIOSONIC  = 'AudioSonicTablet';
    const DEVICE_TABLET_AMPE        = 'AMPETablet';
    const DEVICE_TABLET_SKK         = 'SkkTablet';
    const DEVICE_TABLET_TECNO       = 'TecnoTablet';
    const DEVICE_TABLET_JXD         = 'JXDTablet';
    const DEVICE_TABLET_IJOY        = 'iJoyTablet';
    const DEVICE_TABLET_FX2         = 'FX2Tablet';
    const DEVICE_TABLET_XORO        = 'XoroTablet';
    const DEVICE_TABLET_VIEWSONIC   = 'ViewsonicTablet';
    const DEVICE_TABLET_ODYS        = 'OdysTablet';
    const DEVICE_TABLET_CAPTIVA     = 'CaptivaTablet';
    const DEVICE_TABLET_ICONBIT     = 'IconbitTablet';
    const DEVICE_TABLET_TECLAST     = 'TeclastTablet';
    const DEVICE_TABLET_ONDA        = 'OndaTablet';
    const DEVICE_TABLET_JAYTECH     = 'JaytechTablet';
    const DEVICE_TABLET_BLAUPUNKT   = 'BlaupunktTablet';
    const DEVICE_TABLET_DIGMA       = 'DigmaTablet';
    const DEVICE_TABLET_EVOLIO      = 'EvolioTablet';
    const DEVICE_TABLET_LAVA        = 'LavaTablet';
    const DEVICE_TABLET_CELKON      = 'CelkonTablet';
    const DEVICE_TABLET_WOLDER      = 'WolderTablet';
    const DEVICE_TABLET_MI          = 'MiTablet';
    const DEVICE_TABLET_NIBIRU      = 'NibiruTablet';
    const DEVICE_TABLET_NEXO        = 'NexoTablet';
    const DEVICE_TABLET_UBISLATE    = 'UbislateTablet';
    const DEVICE_TABLET_POCKETBOOK  = 'PocketBookTablet';
    const DEVICE_TABLET_HUDL        = 'Hudl';
    const DEVICE_TABLET_TELSTRA     = 'TelstraTablet';
    const DEVICE_TABLET_GENERIC     = 'GenericTablet';

} 