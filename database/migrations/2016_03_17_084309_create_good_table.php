<?php

use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateGoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getTable(), function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('good_id');
            $table->string('name')->default('');
            $table->string('simple_name')->default('');
            $table->string('full_name')->default('');
            $table->string('pinyin')->default('');
            $table->string('letter')->default('');
            $table->string('fletter')->default('');
            $table->string('brand_id')->default('');
            //            $table->string('category_id')->default('');
            $table->string('description',1000)->default('');
            $table->text('detail_html');
            $table->string('cover_image',1000)->default('');
            $table->string('preview_images',1000)->default('');
            $table->string('detail_images',6000)->default('');
            $table->string('post_images',1000)->default('');
            $table->string('url')->default('');
            $table->string('posts_ids',1000)->default('');
            $table->float('price')->default(0);
            $table->float('ori_price')->default(0);
            $table->float('discount')->default(0);
            $table->string('tags',1000)->default('');
            $table->string('purchase_url',1000)->default('');
            $table->string('rebate_url',1000)->default('');
            $table->string('third_source')->default('');
            $table->string('third_id')->default('');
            $table->string('third_hash')->default('');
            $table->enum('purchase_type',array('default','other'))->default('default');
            $table->enum('type',array('default','other'))->default('default');
            $table->enum('state',array('default','other'))->default('default');
            $table->integer('manual_order')->default(0);
            $table->integer('like_count')->unsigned()->default(0);
            $table->integer('share_count')->unsigned()->default(0);
            $table->integer('comment_count')->unsigned()->default(0);
            $table->integer('favor_count')->unsigned()->default(0);
            $table->integer('fake_like_count')->unsigned()->default(0);
            $table->integer('fake_favor_count')->unsigned()->default(0);
            $table->integer('fake_share_count')->unsigned()->default(0);
            $table->integer('fake_comment_count')->unsigned()->default(0);
            $table->timestamp('created_at')->default(new Expression('current_timestamp'));
            $table->timestamp('updated_at');
            $table->unique('good_id');
            Event::fire(static::$EVENT_CREATE_SCHEMA,$table);
        });
    }

}
