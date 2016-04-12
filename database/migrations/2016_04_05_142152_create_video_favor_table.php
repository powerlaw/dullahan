<?php

use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateVideoFavorTable extends Migration
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

            $table->string('user_id')->default('');
            $table->string('video_id')->default('');
            $table->timestamp('created_at')->default(new Expression('current_timestamp'));
            $table->timestamp('updated_at');

            $table->unique(['user_id','video_id']);
            Event::fire(static::$EVENT_CREATE_SCHEMA,$table);
        });
    }


}
