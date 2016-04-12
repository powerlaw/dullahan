<?php
use Monolog\Logger;
return [
    '_default'=>[
        'enable'=>true,
        'path'=>storage_path('logs'),
        'filename_format'=>'{filename}.{date}',
        'suffix'=>'log',
        'file_date_format'=>'Ymd',
        'line_formatter'=>"[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
        'line_date_format'=>'Y-m-d H:i:s',
        'level'=>Logger::INFO,
        'max_files'=>5,
        'bubble'=>false,
        'permission'=>0777,
        'use_locking'=>false,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
            'Monolog\Processor\WebProcessor',
            'Monolog\Processor\IntrospectionProcessor',
        ]
    ],
    'laravel'=>[],
    'request'=>[
        'enable'=>true,
        'line_formatter'=>"[%datetime%] %extra.process_id% %extra.ip% %context.time% %context.httpcode% %extra.http_method% %message% %context%\n",
        'level'=>Logger::INFO,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
            'Monolog\Processor\WebProcessor',
        ]
    ],
    'response'=>[
        'enable'=>true,
        'line_formatter'=>"[%datetime%] %extra.process_id% %extra.ip% %context.time% %context.httpcode% %extra.http_method% %context.url% %message% \n",
        'level'=>Logger::INFO,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
            'Monolog\Processor\WebProcessor',
        ]
    ],
    'error'=>[
        'enable'=>true,
        //        'line_formatter'=>"[%datetime%] %extra.process_id% %extra.file% %extra.line% %extra.class% %extra.class%\n%message% \n",
        'line_formatter'=>"[%datetime%] %extra.process_id% %context.name% %context.file% %context.line% %context.class%%context.type%%context.function%()\n%message% \n",
        'level'=>Logger::ERROR,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
        ]
    ],
    'curl'=>[
        'enable'=>true,
        'line_formatter'=>"%message%\n",
        'level'=>Logger::INFO,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
        ]
    ],
    'sql'=>[
        'enable'=>true,
        'line_formatter'=>"[%datetime%] %extra.process_id% %context.time% %message%\n",
        'level'=>Logger::INFO,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
        ]
    ],
    'mongo'=>[
        'enable'=>true,
        'line_formatter'=>"[%datetime%] %extra.process_id% %context.time% %message%\n",
        'level'=>Logger::INFO,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
        ]
    ],
    'redis'=>[
        'enable'=>true,
        'line_formatter'=>"[%datetime%] %extra.process_id% %context.time% %message%\n",
        'level'=>Logger::INFO,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
        ]
    ],
    'memcache'=>[
        'enable'=>true,
        'line_formatter'=>"[%datetime%] %extra.process_id% %context.time% %message%\n",
        'level'=>Logger::INFO,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
        ]
    ],
    'hbase'=>[
        'enable'=>true,
        'line_formatter'=>"[%datetime%] %extra.process_id% %context.time% %message%\n",
        'level'=>Logger::INFO,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
        ]
    ],
    'cassandra'=>[
        'enable'=>true,
        'line_formatter'=>"[%datetime%] %extra.process_id% %context.time% %message%\n",
        'level'=>Logger::INFO,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
        ]
    ],
    'couchbase'=>[
        'enable'=>true,
        'line_formatter'=>"[%datetime%] %extra.process_id% %context.time% %message%\n",
        'level'=>Logger::INFO,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
        ]
    ],
    'kafka'=>[
        'enable'=>true,
        'line_formatter'=>"[%datetime%] %extra.process_id% %context.time% %message%\n",
        'level'=>Logger::INFO,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
        ]
    ],
    'thrift'=>[
        'enable'=>true,
        'line_formatter'=>"[%datetime%] %extra.process_id% %context.time% %message%\n",
        'level'=>Logger::INFO,
        'processors'=>[
            'Monolog\Processor\ProcessIdProcessor',
        ]
    ],
];
