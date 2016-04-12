<?php namespace App\Repositories;

use App\Models\Good;
use App\Models\GoodFavor;
use DB;
use ERR;
use Header;

class GoodRepository extends BaseRepository {

    public function __construct(
        Good $model,
        GoodFavor $goodFavorModel
        )
    {
        $this->model = $model;
        $this->goodFavorModel = $goodFavorModel;
    }
	public function lists($repodata)
	{
	    $limitop = $repodata['updown']==1 ? '>' : '<';
        $order = $repodata['updown']==1 ? 'asc' : 'desc';

        $select = $this->model->getSelect($repodata['fields']);
        $query = $this->model->select($select);

        if (!empty($repodata['q'])){
            $query->where('name','like','%'.$repodata['q'].'%');
        }

        if ($repodata['updown']!=-1 || $repodata['offset']!=0){
            $query = $query->where('good_id',$limitop,$repodata['offset']);
        }
        $query = $query->orderBy('id',"desc");
        if(!empty($repodata['sort'])) $query = $query->orderByRaw($repodata['sort']);
        $query = $query->with("videos");
        $items =  $query->paginate($repodata['limit']);

        $data = $items->toArray();
        $data = $data['data'];
        foreach($data as $key=>$good) {
            $data[$key] = static::fakeCount($data[$key]);
            $data[$key] = static::commaToArray($data[$key],['preview_images','detail_images']);
            //            $data[$key] = static::transformTags($data[$key]);
        }
        return ERR::R(ERR::D($data),Header::page($items));
	}

	public function show($repodata)
	{
        $select = $this->model->getSelect($repodata['fields']);
        $query = $this->model->select($select);
        $query = $query->where('good_id',$repodata['good_id']);
        $item = $query->first();
        if (!empty($item))
        {
            $data = $item->toArray();
            $data = static::fakeCount($data);
            $data = static::commaToArray($data,['preview_images','detail_images']);
            $html = view('good.app',compact('data'))->render();
//            $html = view('welcome')->render();
            $data['detail_html'] = $html;
            $data['share_url'] = "http://vqiho.com/goods/".$item['good_id'];
            $favor = $this->goodFavorModel
                ->where('user_id',$repodata['user_id'])
                ->where('good_id',$repodata['good_id'])
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

}
