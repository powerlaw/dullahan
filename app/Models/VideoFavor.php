<?php namespace App\Models;

use App\Models\Base\MysqlModel as Model;

//use Illuminate\Database\Eloquent\Model;

class VideoFavor extends Model
{
    protected $useNatureKey = false;

    protected $fillable = [
        "user_id",
        "video_id",
    ];

    protected $displayAttributes = [
        "id",
        "user_id",
        "video_id",
        "created_at",
        "updated_at"
    ];
}

