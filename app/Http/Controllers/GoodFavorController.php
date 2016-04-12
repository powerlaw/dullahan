<?php namespace App\Http\Controllers;

use App\Repositories\GoodFavorRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\GoodFavorRequest;


class GoodFavorController extends Controller {
    function __construct(GoodFavorRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @SWG\Get(path="/goods/favors",tags={"商品"},summary="收藏列表",description="暂无",operationId="good.favor.list",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="integer",description="用户ID"),
     *   @SWG\Parameter(name="offset",default="0",in="query",type="integer",description="起始位置"),
     *   @SWG\Parameter(name="limit",default="20",in="query",type="integer",description="获取数量"),
     *   @SWG\Parameter(name="updown",default="-1",in="query",type="integer",description="方向(1:正序,-1:逆序)"),
     *   @SWG\Parameter(name="fields",in="query",type="string",description="指定字段(id,name)"),
     *   @SWG\Parameter(name="sort",in="query",type="string",description="排序字段(name,-id)"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
	public function index(GoodFavorRequest $request)
	{
        $offset = $request->input('offset',0);
        $limit = $request->input('limit',20);
        $updown = $request->input('updown',-1);
        $fields = $request->input('fields');
        $sort = $request->input('sort');
        $user_id = $request->input('user_id');
        $repodata = compact('offset','limit','updown','fields','sort','user_id');
        $responseData = $this->repo->lists($repodata);
        return response()->json($responseData,200,[],JSON_UNESCAPED_UNICODE);
	}

    /**
     * @SWG\Post(path="/goods/{good_id}/favors",tags={"商品"},summary="收藏",description="暂无",operationId="good.favor.store",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="integer",description="用户ID"),
     *   @SWG\Parameter(name="good_id",default="100000000000000000",in="path",required=true,type="integer",description="ID"),
     *   @SWG\Parameter(name="fields",in="query",type="string",description="指定字段(id,name)"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
	public function store(GoodFavorRequest $request,$good_id)
	{
        $user_id = $request->input('user_id');
        $fields = $request->input('fields');
        $repodata = compact('good_id','user_id','fields');
        $responseData = $this->repo->store($repodata);
        return response()->json($responseData,200,[],JSON_UNESCAPED_UNICODE);
	}

    /**
     * @SWG\Delete(path="/goods/{good_id}/favors",tags={"商品"},summary="取消收藏",description="暂无",operationId="good.favor.destroy",
     *   consumes={"application/json"},produces={"application/json"},
     *   @SWG\Parameter(name="user_id",default="100000000000000000",in="query",type="integer",description="用户ID"),
     *   @SWG\Parameter(name="good_id",default="100000000000000000",in="path",required=true,type="integer",description="ID"),
     *   @SWG\Parameter(name="fields",in="query",type="string",description="指定字段(id,name)"),
     *   @SWG\Response(response=200,description="OK"),
     *   @SWG\Response(response="422", description="Unprocessable Entity"),
     * ),
     */
	public function destroy(GoodFavorRequest $request,$good_id)
	{
        $user_id = $request->input('user_id');
        $fields = $request->input('fields');
        $bizData = compact('good_id','user_id','fields');
        $responseData = $this->repo->destroy($bizData);
        return response()->json($responseData,200,[],JSON_UNESCAPED_UNICODE);
	}
}
