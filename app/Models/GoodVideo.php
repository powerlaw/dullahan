<?php namespace App\Models;

use App\Models\Base\MysqlModel as Model;

//use Illuminate\Database\Eloquent\Model;

class GoodVideo extends Model
{
    protected $pivot = true;
    protected $useNatureKey = false;

    protected $fillable = [
        "good_video_id",
    ];

    protected $displayAttributes = [
        "id",
        "good_video_id",
        "created_at",
        "updated_at"
    ];
}

