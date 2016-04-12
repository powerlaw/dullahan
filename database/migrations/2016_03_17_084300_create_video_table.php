<?php

use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateVideoTable extends Migration
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
            $table->string('video_id');
            $table->string('title')->default('');
            $table->string('description',1000)->default('');
            $table->string('cover_image',1000)->default('');
            $table->text('detail_html');
            $table->string('play_url')->default('');
            $table->string('embed_url')->default('');
            $table->string('download_url')->default('');
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
            $table->unique('video_id');
            Event::fire(static::$EVENT_CREATE_SCHEMA,$table);
        });
    }
}
