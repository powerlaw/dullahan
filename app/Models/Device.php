<?php namespace App\Models;

use App\Models\Base\MysqlModel as Model;

//use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $useNatureKey = false;

    public function user()
    {
        return $this->belongsTo('User');
    }

    protected $fillable = [
        "device_id",
        "user_id",
        "push_token",
        "os",
        "type",
        "os_version",
        "rom",
        "rom_version",
        "model",
        "brand",
        "manufacturer",
    ];

    protected $displayAttributes = [
        "id",
        "device_id",
        "created_at",
        "updated_at"
    ];
}

