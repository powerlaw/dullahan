<?php namespace App\Models;

use App\Models\Base\MysqlModel as Model;

//use Illuminate\Database\Eloquent\Model;

class Sns extends Model
{
    protected $useNatureKey = false;

    protected $fillable = [
        "sns_id",
        "union_id",
        "user_id",
        "type",
        "platform_id",
        "nickname",
        "avatar",
    ];

    public function user()
    {
        return $this->belongsTo('User','user_id','user_id');
    }

    protected $displayAttributes = [
        "id",
        "sns_id",
        "union_id",
        "type",
        "platform_id",
        "nickname",
        "avatar",
        "created_at",
        "updated_at"
    ];
}

