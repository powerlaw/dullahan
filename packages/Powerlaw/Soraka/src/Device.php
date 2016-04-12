<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/10
 * Time: 下午10:26
 */

namespace Powerlaw\Soraka;


class Device {

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