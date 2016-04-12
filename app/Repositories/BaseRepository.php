<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 16/3/18
 * Time: 上午1:31
 */

namespace App\Repositories;


class BaseRepository {

    protected $dao;

    public function getCount()
    {
        return $this->dao->count();
    }

    public function destroy($id)
    {
        $this->getById($id)->delete();
    }

    public function getById($id)
    {
        return $this->dao->findOrFail($id);
    }

    public static function fakeCount($object)
    {
        $object['like_count'] += $object['fake_like_count'];
        $object['favor_count'] += $object['fake_favor_count'];
        $object['share_count'] += $object['fake_share_count'];
        $object['comment_count'] += $object['fake_comment_count'];
        unset($object['fake_like_count']);
        unset($object['fake_favor_count']);
        unset($object['fake_share_count']);
        unset($object['fake_comment_count']);
        return $object;
    }
    public static function commaToArray($object,$keys = [])
    {
        foreach ($keys as $key)
        {
            $object[$key] = empty($object[$key]) ? [] : explode(',',$object[$key]);
        }
        return $object;
    }
} 