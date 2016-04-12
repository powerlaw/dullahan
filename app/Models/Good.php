<?php namespace App\Models;

use App\Models\Base\MysqlModel as Model;

//use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $useNatureKey = true;

    protected $fillable = [
        "good_id",
    ];
    public  function videos() {
        return $this->belongsToMany("Video");
    }

//    protected $displayAttributes = [
//        "id",
//        "good_id",
//        "created_at",
//        "updated_at"
//    ];
}

