<?php namespace App\Models;

use App\Models\Base\MysqlModel as Model;

//use Illuminate\Database\Eloquent\Model;

class GoodFavor extends Model
{
    protected $useNatureKey = false;

    protected $fillable = [
        "user_id",
        "good_id",
    ];

    protected $displayAttributes = [
        "id",
        "user_id",
        "good_id",
        "created_at",
        "updated_at"
    ];
}

