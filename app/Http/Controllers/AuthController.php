<?php namespace App\Http\Controllers;

use App\Repositories\AuthRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;

use App\Http\Constants;


class AuthController extends Controller {
    function __construct(AuthRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @SWG\Get(path="/auth/id",tags={"用户权限"},summary="得到ID",description="暂无",operationId="auth.id",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="string",description="用户ID"),
     *   @SWG\Parameter(name="device_id",default="100000000000000000",in="query",type="string",description="设备"),
     *   @SWG\Parameter(name="device_info",default="100000000000000000",in="query",type="string",description="设备信息"),
     *   @SWG\Parameter(name="client_type",default="100000000000000000",in="query",type="string",description="客户端类型"),
     *   @SWG\Parameter(name="fields",in="query",type="string",description="指定字段(id,name)"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
    public function id(AuthRequest $request)
    {
        $user_id  = $request->input('user_id',null);
        $device_id = $request->input('device_id');
        $device_info = $request->input('device_info','');
        $client_type = $request->input('client_type', Constants::CODE_CLIENT_DEFAULT);

        $sns_id = $request->input('sns_id');
        $sns_type = $request->input('sns_type',Constants::CODE_SNS_DEFAULT);
        $fields = $request->input('fields');

        $bizData      = compact(
            'client_type',
            'loginame','password','device_id','device_info',
            'user_id','sns_id','sns_type',
            'fields'
        );
        $responseData = $this->repo->id($bizData);
        return response()->json($responseData, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @SWG\Get(path="/auth/bootstrap",tags={"用户权限"},summary="初始化",description="暂无",operationId="auth.bootstrap",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="string",description="用户ID"),
     *   @SWG\Parameter(name="device_id",default="100000000000000000",in="query",type="string",description="设备"),
     *   @SWG\Parameter(name="device_info",default="{""os"":10000}",in="query",type="string",description="设备信息"),
     *   @SWG\Parameter(name="client_type",default="20100",in="query",type="string",description="客户端类型"),
     *   @SWG\Parameter(name="fields",in="query",type="string",description="指定字段(id,name)"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
    public function bootstrap(AuthRequest $request)
    {
        $user_id  = $request->input('user_id',null);
        $device_id = $request->input('device_id');
        $device_info = $request->input('device_info','');
        $client_type = $request->input('client_type', Constants::CODE_CLIENT_DEFAULT);

        $sns_id = $request->input('sns_id');
        $sns_type = $request->input('sns_type',Constants::CODE_SNS_DEFAULT);
        $fields = $request->input('fields');

        $bizData      = compact(
            'client_type',
            'loginame','password','device_id','device_info',
            'user_id','sns_id','sns_type',
            'fields'
        );
        $responseData = $this->repo->bootstrap($bizData);
        return response()->json($responseData, 200, [], JSON_UNESCAPED_UNICODE);
    }

    //http://localhost:8000/auth/login?sns_id=1714926623&sns_type=weibo&nickname=%E5%B9%BF%E5%9C%BA25-%E8%B0%A2%E6%84%8F&avatar=http://tp4.sinaimg.cn/1714926623/180/5653481386/1
    /**
     * @SWG\Get(path="/auth/login",tags={"用户权限"},summary="登录",description="暂无",operationId="auth.login",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="string",description="用户ID"),
     *   @SWG\Parameter(name="loginame",default="",in="query",type="string",description="用户名|邮箱|手机号码|用户ID"),
     *   @SWG\Parameter(name="password",default="",in="query",type="string",description="密码"),
     *   @SWG\Parameter(name="device_id",default="c6c34af361e26e3967531ff8b851d674d7f79b72",in="query",type="string",description="设备"),
     *   @SWG\Parameter(name="device_info",default="{""os"":10000}",in="query",type="string",description="设备信息"),
     *   @SWG\Parameter(name="push_token",default="43c23864b7dc121381cf7d71b556a03128258ae5af73d3f184e3ec5f503a628f",in="query",type="string",description="设备信息"),
     *   @SWG\Parameter(name="client_type",default="20100",in="query",type="string",description="客户端类型"),
     *   @SWG\Parameter(name="sns_id",default="1714926623",in="query",type="string",description="社交网络ID"),
     *   @SWG\Parameter(name="union_id",default="",in="query",type="string",description="微信开放平台 Union ID"),
     *   @SWG\Parameter(name="sns_type",default="200",in="query",type="string",description="社交网络类型"),
     *   @SWG\Parameter(name="nickname",default="nickname",in="query",type="string",description="昵称"),
     *   @SWG\Parameter(name="avatar",default="http://tp4.sinaimg.cn/1714926623/180/5653481386/1",in="query",type="string",description="头像"),
     *   @SWG\Parameter(name="fields",in="query",type="string",description="指定字段(id,name)"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
    public function login(AuthRequest $request)
    {
        $user_id  = $request->input('user_id', '');
        $loginame = $request->input('loginame');
        $password = $request->input('password');
        $device_id = $request->input('device_id');
        $device_info = $request->input('device_info','');
        $client_type = $request->input('client_type', Constants::CODE_CLIENT_DEFAULT);
        $push_token = $request->input('push_token', '');

        $sns_id = $request->input('sns_id');
        $union_id = $request->input('union_id');
        //        $platform_id = $request->input('platform_id');
        $nickname = $request->input('nickname','');
        $avatar = $request->input('avatar','');
        $sns_type = $request->input('sns_type',Constants::CODE_SNS_DEFAULT);
        $fields = $request->input('fields');

        $bizData      = compact(
            'client_type',
            'loginame','password','device_id','device_info','push_token',
            'user_id','sns_id','union_id','sns_type','platform_id','nickname','avatar',
            'fields'
        );
        $responseData = $this->repo->login($bizData);
        return response()->json($responseData, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @SWG\Get(path="/auth/register",tags={"用户权限"},summary="注册",description="暂无",operationId="auth.register",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="string",description="用户ID"),
     *   @SWG\Parameter(name="loginame",default="",in="query",type="string",description="用户名|邮箱|手机号码|用户ID"),
     *   @SWG\Parameter(name="password",default="",in="query",type="string",description="密码"),
     *   @SWG\Parameter(name="device_id",default="",in="query",type="string",description="设备"),
     *   @SWG\Parameter(name="device_info",default="{""os"":10000}",in="query",type="string",description="设备信息"),
     *   @SWG\Parameter(name="push_token",default="",in="query",type="string",description="设备信息"),
     *   @SWG\Parameter(name="client_type",default="20100",in="query",type="string",description="客户端类型"),
     *   @SWG\Parameter(name="sns_id",default="1714926623",in="query",type="string",description="社交网络ID"),
     *   @SWG\Parameter(name="union_id",default="",in="query",type="string",description="微信开放平台 Union ID"),
     *   @SWG\Parameter(name="sns_type",default="200",in="query",type="string",description="社交网络类型"),
     *   @SWG\Parameter(name="nickname",default="nickname",in="query",type="string",description="昵称"),
     *   @SWG\Parameter(name="avatar",default="http://tp4.sinaimg.cn/1714926623/180/5653481386/1",in="query",type="string",description="头像"),
     *   @SWG\Parameter(name="fields",in="query",type="string",description="指定字段(id,name)"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
    public function register(AuthRequest $request)
    {
        $user_id  = $request->input('user_id', '');
        $loginame = $request->input('loginame');
        $password = $request->input('password');
        $smscode = $request->input('smscode');
        $captcha = $request->input('captcha');
        $device_id = $request->input('device_id');
        $device_info = $request->input('device_info','');
        $client_type = $request->input('client_type', Constants::CODE_CLIENT_DEFAULT);

        $sns_id = $request->input('sns_id');
        $union_id = $request->input('union_id');
        $sns_type = $request->input('sns_type',Constants::CODE_SNS_DEFAULT);
        $fields = $request->input('fields');

        $bizData      = compact(
            'client_type','smscode','captcha',
            'loginame','password','device_id','device_info',
            'user_id','sns_id','union_id','sns_type',
            'fields'
        );
        $responseData = $this->repo->register($bizData);
        return response()->json($responseData, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @SWG\Get(path="/auth/logout",tags={"用户权限"},summary="退出",description="暂无",operationId="auth.logout",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="string",description="用户ID"),
     *   @SWG\Parameter(name="fields",in="query",type="string",description="指定字段(id,name)"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
    public function logout(AuthRequest $request)
    {
        $user_id  = $request->input('user_id', '');
        $fields  = $request->input('fields');
        $bizData      = compact('user_id','fields');
        $responseData = $this->repo->logout($bizData);
        return response()->json($responseData, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @SWG\Get(path="/auth/bind",tags={"用户权限"},summary="绑定",description="暂无",operationId="auth.bind",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="string",description="用户ID"),
     *   @SWG\Parameter(name="device_id",default="",in="query",type="string",description="设备"),
     *   @SWG\Parameter(name="device_info",default="{""os"":10000}",in="query",type="string",description="设备信息"),
     *   @SWG\Parameter(name="client_type",default="20100",in="query",type="string",description="客户端类型"),
     *   @SWG\Parameter(name="sns_id",default="1714926623",in="query",type="string",description="社交网络ID"),
     *   @SWG\Parameter(name="sns_type",default="200",in="query",type="string",description="社交网络类型"),
     *   @SWG\Parameter(name="fields",in="query",type="string",description="指定字段(id,name)"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
    public function bind(AuthRequest $request)
    {
        $user_id  = $request->input('user_id', '');
        $device_id = $request->input('device_id');
        $device_info = $request->input('device_info','');
        $client_type = $request->input('client_type', Constants::CODE_CLIENT_DEFAULT);

        $sns_id = $request->input('sns_id');
        $sns_type = $request->input('sns_type',Constants::CODE_SNS_DEFAULT);
        $fields = $request->input('fields');

        $bizData      = compact(
            'client_type',
            'device_id','device_info',
            'user_id','sns_id','sns_type',
            'fields'
        );
        $responseData = $this->repo->bind($bizData);
        return response()->json($responseData, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @SWG\Get(path="/auth/unbind",tags={"用户权限"},summary="解绑",description="暂无",operationId="auth.unbind",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="string",description="用户ID"),
     *   @SWG\Parameter(name="device_id",default="",in="query",type="string",description="设备"),
     *   @SWG\Parameter(name="device_info",default="{""os"":10000}",in="query",type="string",description="设备信息"),
     *   @SWG\Parameter(name="client_type",default="20100",in="query",type="string",description="客户端类型"),
     *   @SWG\Parameter(name="sns_id",default="1714926623",in="query",type="string",description="社交网络ID"),
     *   @SWG\Parameter(name="sns_type",default="200",in="query",type="string",description="社交网络类型"),
     *   @SWG\Parameter(name="fields",in="query",type="string",description="指定字段(id,name)"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
    public function unbind(AuthRequest $request)
    {
        $user_id  = $request->input('user_id', '');
        $device_id = $request->input('device_id');
        $device_info = $request->input('device_info','');
        $client_type = $request->input('client_type', Constants::CODE_CLIENT_DEFAULT);

        $email = $request->input('email','');
        $mobile = $request->input('mobile','');
        $sns_id = $request->input('sns_id');
        $sns_type = $request->input('sns_type',Constants::CODE_SNS_DEFAULT);
        $fields = $request->input('fields');

        $bizData      = compact(
            'client_type',
            'device_id','device_info',
            'user_id','sns_id','sns_type','email','mobile',
            'fields'
        );
        $responseData = $this->repo->unbind($bizData);
        return response()->json($responseData, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @SWG\Get(path="/auth/token",tags={"用户权限"},summary="获取Token",description="暂无",operationId="auth.token",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="string",description="用户ID"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
    public function token(AuthRequest $request)
    {
        $user_id  = $request->input('user_id', '');
        $bizData      = compact('user_id');
        $responseData = $this->repo->token($bizData);
        return response()->json($responseData, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @SWG\Get(path="/auth/smscode",tags={"用户权限"},summary="获取短信验证码",description="暂无",operationId="auth.smscode",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="string",description="用户ID"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
    public function smscode(AuthRequest $request)
    {
        $user_id  = $request->input('user_id', '');
        $bizData      = compact('user_id');
        $responseData = $this->repo->smscode($bizData);
        return response()->json($responseData, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
