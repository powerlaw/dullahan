<?php namespace App\Models;

use App\Models\Base\MysqlModel as Model;

//use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $useNatureKey = true;

    protected $fillable = [
        "video_id",
    ];
    public function goods()
    {
        return $this->belongsToMany('Good');
    }

//    protected $displayAttributes = [
//        "id",
//        "video_id",
//        "created_at",
//        "updated_at"
//    ];

}

