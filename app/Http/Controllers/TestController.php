<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use ID;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $data = [
//            'headers'=>$http_response_header
            'server'=>$_SERVER,
            'cookie'=>$_COOKIE,
            'env'=>$_ENV,
            'files'=>$_FILES,
            'get'=>$_GET,
            'post'=>$_POST,
            'request'=>$_REQUEST,
            'session'=>@$_SESSION,
//            'cookie'=>php_sapi_name(),
        ];
        return response()->json($data);

    }
}
