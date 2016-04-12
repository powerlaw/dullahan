<?php namespace App\Repositories;

use App\Models\Video;
use App\Models\VideoFavor;
use DB;
use ERR;
use Header;
use Config;

class VideoRepository extends BaseRepository {

    public function __construct(
        Video $model,
        VideoFavor $videoFavorModel
        )
    {
        $this->model = $model;
        $this->videoFavorModel = $videoFavorModel;
    }
	public function lists($repodata)
	{
	    $limitop = $repodata['updown']==1 ? '>' : '<';
        $order = $repodata['updown']==1 ? 'asc' : 'desc';

        $select = $this->model->getSelect($repodata['fields']);
        $query = $this->model->select($select);

        if (!empty($repodata['q'])){
            $query->where('title','like','%'.$repodata['q'].'%');
        }

        if ($repodata['updown']!=-1 || $repodata['offset']!=0){
            $query = $query->where('video_id',$limitop,$repodata['offset']);
        }
        $query = $query->orderBy("id","desc");
        if(!empty($repodata['sort'])) $query = $query->orderByRaw($repodata['sort']);
        $items =  $query->paginate($repodata['limit']);

        $data = $items->toArray();
        $data = $data['data'];
        foreach($data as $key=>$good) {
            $data[$key] = static::fakeCount($data[$key]);
//            $data[$key] = static::transformImage($data[$key]);
//            $data[$key] = static::transformTags($data[$key]);
        }
        return ERR::R(ERR::D($data),Header::page($items));
	}

	public function show($repodata)
	{
        $select = $this->model->getSelect($repodata['fields']);
        $query = $this->model->select($select);
        $query = $query->where('video_id',$repodata['video_id']);
        $item = $query->first();
        if (!empty($item)){
            $data = $item->toArray();
            $data = static::fakeCount($data);
            $data['goods'] = $item->goods->toArray();
            $data['share_url'] = "http://vqiho.com/videos/".$item['video_id'];
            $data['play_url'] = $this->getPlayUrl($data['goods'][0]['third_id'],'mp4');
//            $data['play_url'] = "http://7xptgb.com2.z0.glb.qiniucdn.com/video/xvid.mp4";
            $favor = $this->videoFavorModel
                ->where('user_id',$repodata['user_id'])
                ->where('video_id',$repodata['video_id'])
                ->first();
            if ($favor) {
                $data['is_favored'] = 1;
            }else{
                $data['is_favored'] = 0;
            }
        }else{
            $data = (object)null;
        }
        return ERR::R(ERR::D($data));
	}

	public function create($repodata)
	{
	}

	public function store($repodata)
	{
	}

	public function edit($repodata)
	{
	}

	public function update($repodata)
	{
	}

	public function destroy($repodata)
	{
	}

    public function getPlayUrl($id, $suffix = "flv", $prefix = 'tmall')
    {
        return $data['play_url'] =
            "http://".
            Config::get("filesystems.disks.qiniu.domains.default").
            "/video/".$prefix."_".$id.".".$suffix;
    }
}
