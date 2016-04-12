<?php

namespace App\Models;

use App\Models\Base\MysqlModel as Model;

class User extends Model
{
    protected $fillable = ['user_id','username', 'email', 'password','nickname','avatar','sns_id'];

    protected $hidden = ['password', 'remember_token'];

    public function postFavors()
    {
        $this->hasMany('PostFavors');
    }
    public function goodFavors()
    {
        $this->hasMany('GoodFavors');
    }
    public function devices()
    {
        return $this->hasMany('Device');
    }
    public function snses()
    {
        return $this->hasMany('Sns');
    }
}
