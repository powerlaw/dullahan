<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin;

use App\Console\Commands\Utils\EchoCommand;

class AdminSeeder extends Seeder {
    public $command;

    function __construct()
    {
        $this->command = new EchoCommand();
    }

    public function run()
	{
        Admin::truncate();
        $items = User::get();
        $items = $items->toArray();
//        var_dump($items);die;

        foreach($items as $index=>$item)
        {
//            var_dump($item->toArray());die;
            Admin::create($item);
//            $videoObj = [
//                'title'=>$item['videoDO']['title'],
//                'description'=>$item['videoDO']['description'],
//                'cover_image'=>$item['videoDO']['coverImage'],
//                'playUrl'=>'',
//                'downloadUrl'=>$item['videoDO']['url'],
//                'embedUrl'=>$item['videoDO']['playUrl'],
//                'fake_like_count'=>rand(1,10000),
//                'fake_favor_count'=>rand(1,10000),
//                'fake_share_coun;diet'=>rand(1,10000),
//                'fake_comment_count'=>rand(1,10000),
//            ];
//            $goodObj = [
//                'name'=>$item['itemDO']['title'],
//                'simple_name'=>$item['itemDO']['title'],
//                'full_name'=>$item['itemDO']['title'],
//                'description'=>array_get($item,'itemDO.description',''),
//                'cover_image'=>$item['thumbImages'][0],
//                'preview_images'=>implode(',',$item['thumbImages']),
//                'detail_images'=>implode(',',$item['descImages']),
//                'price'=>$item['itemDO']['reservePrice'],
//                'third_source'=>'tmall',
//                'third_id'=>$item['itemDO']['itemId'],
//                'fake_like_count'=>rand(1,10000),
//                'fake_favor_count'=>rand(1,10000),
//                'fake_share_count'=>rand(1,10000),
//                'fake_comment_count'=>rand(1,10000),
//            ];
//            $videoObj = Video::create($videoObj)->toArray();
//            $goodObj = Good::create($goodObj)->toArray();
//            GoodVideo::create([
//                'good_id'=>$goodObj['good_id'],
//                'video_id'=>$videoObj['video_id'],
//            ]);
//            $this->command->info($index." ".$goodObj['good_id']." ".$videoObj['video_id']);
        }

//        GoodVideo::create([
//            'good_video_id' => str_pad(1,18,"0",STR_PAD_RIGHT),
//        ]);
//		for ($i=0; $i < 10; $i++) {
//            $time = time();
//            GoodVideo::create([
//                'filed1' => "test_{$i}_{$time}",
//                'filed2' => "test$i@gmail.com",
//            ]);
//        }
	}
}

