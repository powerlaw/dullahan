<?php namespace App\Repositories;

use App\Models\User;
use App\Models\Device;
use App\Models\Sns;

use DB;
use ERR;
use Header;
use ID;
use Hashids;

class AuthRepository extends BaseRepository {

    public function __construct(
        User $userModel,
        Device $deviceModel,
        Sns $snsModel
        )
    {
        $this->userModel = $userModel;
        $this->deviceModel = $deviceModel;
        $this->snsModel = $snsModel;
    }
    public function bootstrap($bizData)
    {
        $select = $this->userModel->getSelect($bizData['fields']);
        $query = $this->userModel->select($select);
        $item =  $query->first();
        $data = $item->toArray();
        return ERR::R(ERR::D($data));
    }
    public function register($bizData)
    {
        $select = $this->userModel->getSelect($bizData['fields']);
        $query = $this->userModel->select($select);
        $item =  $query->first();
        $data = $item->toArray();
        return ERR::R(ERR::D($data));
    }
    public function login($bizData)
    {
        $sns = $this->snsModel
            ->where('sns_id',$bizData['sns_id'])
            ->where('type',$bizData['sns_type'])
            ->first();
        try {
            DB::beginTransaction();
            if (empty($sns)){
                $user_id = ID::gen();
                $user = new User([
                    'user_id'=> $user_id,
                    'nickname'=>$bizData['nickname'],
                    'avatar' => $bizData['avatar'],
                    'sns_id' => $bizData['sns_id'],
                ]);
                $sns = new Sns([
                    'sns_id'=>$bizData['sns_id'],
                    'union_id'=>$bizData['union_id'],
                    'user_id'=>$user_id,
                    'type'=>$bizData['sns_type'],
                    'platform_id'=>$bizData['sns_id'],
                    'nickname'=>$bizData['nickname'],
                    'avatar'=>$bizData['avatar'],
                ]);
                $user->save();
                $sns->save();
            }else{
                $user = $sns->user;
            }
            $device = $this->deviceModel
                ->where('device_id',$bizData['device_id'])
                ->first();
            if (empty($device)){
                $device = new Device([
                    'device_id'=>$bizData['device_id'],
                    'push_token'=>$bizData['push_token'],
                    'user_id'=>$user->user_id,
                    'type'=>$bizData['client_type'],
                ]);
                $device->save();
            }else if($device->user_id!=$user->user_id){
                $device->user_id = $user->user_id;
                $device->save();
            }
            DB::commit();
        }catch (\Exception $e){
            echo $e;die;
            DB::rollBack();
        }
        $user->snses;
        $user->devices;
        $data = $user->toArray();
        return ERR::R(ERR::D($data));
    }

    public function logout($bizData)
    {
        $select = $this->userModel->getSelect($bizData['fields']);
        $query = $this->userModel->select($select);
        $item =  $query->first();
        $data = $item->toArray();
        return ERR::R(ERR::D($data));
    }
    public function bind($bizData)
    {
        $select = $this->userModel->getSelect($bizData['fields']);
        $query = $this->userModel->select($select);
        $item =  $query->first();
        $data = $item->toArray();
        return ERR::R(ERR::D($data));
    }
    public function unbind($bizData)
    {
        $select = $this->userModel->getSelect($bizData['fields']);
        $query = $this->userModel->select($select);
        $item =  $query->first();
        $data = $item->toArray();
        return ERR::R(ERR::D($data));
    }
    public function id($bizData)
    {
        $time = round(microtime(true)*1000);
        $id = ID::gen();
        $data = compact('id');
        return ERR::R(ERR::D($data));
    }

    public function token($bizData)
    {
        $time = round(microtime(true)*1000);
        $token = Hashids::connection('token')->encode($time);
        $data = compact('token');
        return ERR::R(ERR::D($data));
    }

    public function smscode($bizData)
    {
        $time = round(microtime(true)*1000);
        $token = Hashids::connection('token')->encode($time);
        $data = compact('token');
        return ERR::R(ERR::D($data));
    }

    public function store($bizData)
    {
    }

    public function edit($bizData)
    {
    }

    public function update($bizData)
    {
    }

    public function destroy($bizData)
    {
    }
}
