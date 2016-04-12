<?php

use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateSnsTable extends Migration
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
            $table->string('sns_id');
            $table->string('user_id')->nullable();
            $table->string('union_id')->nullable();
            $table->integer('type')->default(0);
            $table->string('platform_id')->default('');
            $table->string('nickname')->default('');
            $table->string('avatar')->default('');
            $table->timestamp('created_at')->default(new Expression('current_timestamp'));
            $table->timestamp('updated_at');
            $table->unique(['type','sns_id']);
            $table->index('sns_id');
            $table->index(['user_id','sns_id']);
            Event::fire(static::$EVENT_CREATE_SCHEMA,$table);
        });
    }
}
