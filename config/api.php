<?php

return [
    'environments'=>[
        'default' => [
            'schema' => 'http',
            'domain' => 'api.vqiho.com',
            'share_domain' => 'www.vqiho.com',
            'ip' => '120.26.101.82',
            'port' => 80,
            'host' => 'domain',
            'headers'=>[],
            'parameters'=>[],
        ],
        'local'=>[
            'schema' => 'http',
            'domain' => 'localhost',
            'share_domain' => 'localhost',
            'ip' => '127.0.0.1',
            'port' => 8000,
            'host' => 'ip',
            'headers'=>[],
            'parameters'=>[],
        ],
        'development'=>[
            'schema' => 'http',
            'domain' => 'xieyi.api.vqiho.com',
            'share_domain' => 'www.vqiho.com',
            'ip' => '218.240.135.68',
            'port' => 80,
            'host' => 'domain',
            'headers'=>[],
            'parameters'=>[],
        ],
        'staging'=>[
            'schema' => 'http',
            'domain' => 'api.vqiho.com',
            'share_domain' => 'www.vqiho.com',
            'ip' => '120.26.101.82',
            'port' => 80,
            'host' => 'ip',
            'headers'=>[],
            'parameters'=>[],
        ],
        'production'=>[
            'schema' => 'http',
            'domain' => 'api.vqiho.com',
            'share_domain' => 'www.vqiho.com',
            'ip' => '120.26.101.82',
            'port' => 80,
            'host' => 'domain',
            'headers'=>[],
            'parameters'=>[],
        ],
    ],
    'swift_file'=> public_path('files').'/apiconstants.swift',
//    'api_file_path'=> storage_path('api'),
    'json_file_path'=> public_path('files'),
    'java_file'=>'',
    'android_file'=>'',

];