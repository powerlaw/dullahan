<?php

use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
class CreateGoodVideoTable extends Migration
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
            $table->string('video_id');
            $table->enum('type',array('default','other'))->default('default');
            $table->enum('state',array('default','other'))->default('default');
            $table->integer('manual_order')->default(0);
            $table->timestamp('created_at')->default(new Expression('current_timestamp'));
            $table->timestamp('updated_at');
            $table->unique(['good_id','video_id']);
            Event::fire(static::$EVENT_CREATE_SCHEMA,$table);
        });
    }

}
