<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 16/3/17
 * Time: 下午5:16
 */

namespace App\Models\Base;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class MongoModel extends Model {
    protected $connection = 'mongodb';

} 