<?php namespace App\Repositories;

use App\Models\VideoFavor;
use App\Models\Video;
use App\Models\User;
use DB;
use ERR;
use Header;

class VideoFavorRepository extends BaseRepository {

    public function __construct(
        VideoFavor $favorModel,
        Video $model,
        User $userModel
    )
    {
        $this->faovrModel = $favorModel;
        $this->model = $model;
        $this->userModel = $userModel;
    }
    public function lists($repodata)
    {
        $natrueKeyName = $this->model->getNatureKeyName();

        $select = $this->model->getSelect($repodata['fields']);

        $query = $this->model->select($select);
        $table = $this->model->fullTableName();

        $joinTable = $this->faovrModel->getTable();
        $query->join($joinTable,function($join) use ($repodata,$table,$joinTable,$natrueKeyName){
            $join->on("$table.$natrueKeyName",'=',"$joinTable.$natrueKeyName")
                ->where("{$joinTable}.user_id",'=',$repodata['user_id']);
        });

        $limitop = $repodata['updown']==1 ? '>' : '<';
        //        $order = $bizData['updown']==1 ? 'asc' : 'desc';

        if ($repodata['updown']!=-1 || $repodata['offset']!=0){
            $repodata['offset'] = date('Y-m-d H:i:s',intval($repodata['offset']));
            $query = $query->where("{$joinTable}.created_at",$limitop,$repodata['offset']);
        }

        $select = array_merge($select,["{$joinTable}.created_at","{$joinTable}.updated_at"]);
        $query->select($select);
        $query = $query->orderBy("{$joinTable}.created_at","desc");
        if(!empty($repodata['sort'])) $query = $query->orderByRaw($repodata['sort']);
        $items =  $query->paginate($repodata['limit']);

        $data = $items->toArray();
        $data = $data['data'];
        foreach($data as $key=>$good) {
            $data[$key] = static::fakeCount($data[$key]);
            $data[$key] = static::commaToArray($data[$key],['preview_images','detail_images']);
        }
        return ERR::R(ERR::D($data),Header::page($items));
    }

    public function store($repodata)
    {
        $natrueKeyName = $this->model->getNatureKeyName();

        $affectedRows = $this->faovrModel->insertIgnore(array_only($repodata, ['user_id', $natrueKeyName]));
        if ($affectedRows){
            $this->model->where($natrueKeyName,$repodata[$natrueKeyName])->increment('favor_count');
        }

        $select = $this->model->getSelect($repodata['fields']);
        $query = $this->model->select($select);
        $query = $query->where($natrueKeyName,$repodata[$natrueKeyName]);
        $item = $query->first();
        $data = empty($item) ? (object)null : $item->toArray();
        if (!empty($item))
        {
            $data = static::fakeCount($item);
            $data = static::commaToArray($data,['preview_images','detail_images']);
            $html = view('good.app',compact('data'))->render();
            $data['detail_html'] = $html;
            $data['share_url'] = "http://vqiho.com/videos/".$item[$natrueKeyName];
        }
        $data['is_favored'] = 1;
        return ERR::R(ERR::D($data));
    }

    public function destroy($repodata)
    {
        $natrueKeyName = $this->model->getNatureKeyName();
        $affectedRows = $this->faovrModel
            ->where('user_id',$repodata['user_id'])
            ->where($natrueKeyName,$repodata[$natrueKeyName])
            ->delete();
        if ($affectedRows){
            $this->model->where($natrueKeyName,$repodata[$natrueKeyName])->decrement('favor_count');
        }

        $select = $this->model->getSelect($repodata['fields']);
        $query = $this->model->select($select);
        $query = $query->where($natrueKeyName,$repodata[$natrueKeyName]);
        $item = $query->first();
        $data = empty($item) ? (object)null : $item->toArray();
        if (!empty($item))
        {
            $data = static::fakeCount($item);
            $data = static::commaToArray($data,['preview_images','detail_images']);
            $html = view('good.app',compact('data'))->render();
            $data['detail_html'] = $html;
            $data['share_url'] = "http://vqiho.com/videos/".$item[$natrueKeyName];
        }
        $data['is_favored'] = 0;
        return ERR::R(ERR::D($data));
    }

}
