<?php namespace App\Http\Controllers;

use App\Models\Video;
use App\Repositories\VideoRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;


class VideoController extends Controller {

    function __construct(VideoRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @SWG\Get(path="/videos",tags={"视频"},summary="列表",description="暂无",operationId="video.list",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="integer",description="用户ID"),
     *   @SWG\Parameter(name="offset",default="0",in="query",type="integer",description="起始位置"),
     *   @SWG\Parameter(name="limit",default="20",in="query",type="integer",description="获取数量"),
     *   @SWG\Parameter(name="updown",default="-1",in="query",type="integer",description="方向(1:正序,-1:逆序)"),
     *   @SWG\Parameter(name="fields",in="query",type="string",description="指定字段(id,name)"),
     *   @SWG\Parameter(name="sort",in="query",type="string",description="排序字段(name,-id)"),
     *   @SWG\Parameter(name="q",in="query",type="string",description="查询关键词"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
	public function index(VideoRequest $request)
	{
		$user_id = $request->input('user_id');
        $offset = $request->input('offset',0);
        $limit = $request->input('limit',20);
        $updown = $request->input('updown',-1);
        $fields = $request->input('fields');
        $sort = $request->input('sort');
        $q = $request->input('q');
        $repodata = compact('user_id','offset','limit','updown','fields','sort','q');
        $responseData = $this->repo->lists($repodata);
//		var_dump($responseData);die;
        return response()->json($responseData,200,[],JSON_UNESCAPED_UNICODE);
	}

    /**
     * @SWG\Get(path="/videos/{video_id}",tags={"视频"},summary="列表",description="暂无",operationId="video.show",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="video_id",default="100000000000000000",in="path",required=true,type="integer",description="ID"),
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="integer",description="用户ID"),
     *   @SWG\Parameter(name="fields",in="query",type="string",description="指定字段(id,name)"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
	public function show(VideoRequest $request,$video_id)
	{
		$user_id = $request->input('user_id');
        $fields = $request->input('fields');
        $repoata = compact('user_id','video_id','fields');
        $responseData = $this->repo->show($repoata);
        return response()->json($responseData,200,[],JSON_UNESCAPED_UNICODE);
	}

	public function create(VideoRequest $request)
	{

	}

	public function store(VideoRequest $request)
	{

	}

	public function edit(VideoRequest $request,$video_id)
	{

	}

	public function update(VideoRequest $request,$video_id)
	{

	}

	public function destroy(VideoRequest $request,$video_id)
	{

	}
}
