<?php
return [
    'providers' => [
        'local'      => [

        ],
        'production' => [

        ],
        '_default'   => [
            Rees\Sanitizer\SanitizerServiceProvider::class,
            \L5Swagger\L5SwaggerServiceProvider::class,
            Vinkla\Hashids\HashidsServiceProvider::class
        ],


    ],
    'aliases'   => [
        'local'      => [

        ],
        'production' => [

        ],
        '_default'   => [
            'Sanitizer' => Rees\Sanitizer\Facade::class,
            'Hashids' => Vinkla\Hashids\Facades\Hashids::class
        ],
    ],
    '_comment'  => [
        'providers' => [

        ],
        'aliases'   => [

        ],
    ],

];