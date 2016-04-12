<?php
use Powerlaw\Eunomia\UUID;
use Powerlaw\Eunomia\SnowFlake;
use Powerlaw\Eunomia\SimpleFlake;
return [
    'snowflake'=>[
        'strategy'=>SnowFlake::STRATEGY_SIMULATE,
//        'epoch'=>'1399029701773',
        'epoch'=>'1435834409000',
    ],
    'simple'=>[
        'strategy'=>SimpleFlake::STRATEGY_SIMULATE,
//        'epoch'=>'1399029701773',
        'epoch'=>'1435834409000',
    ],
    'uuid'=>[
        'strategy'=>UUID::STRATEGY_CLIENT,
        'left_curly'=>'{',
        'right_curly'=>'}',
        'hyphen'=>'-',
        'use_curly'=>false,
        'use_hyphen'=>false,
        'upper_case'=>true,
    ],
];