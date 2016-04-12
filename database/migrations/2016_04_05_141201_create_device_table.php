<?php

use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateDeviceTable extends Migration
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
            $table->string('device_id');
            $table->string('user_id');
            $table->integer('os')->default(0);
            $table->integer('type')->default(0);
            $table->string('os_version')->default('');
            $table->string('rom')->default('');
            $table->string('rom_version')->default('');
            $table->string('model')->default('');
            $table->string('brand')->default('');
            $table->string('manufacturer')->default('');
            $table->string('push_token')->default('');
            $table->timestamp('created_at')->default(new Expression('current_timestamp'));
            $table->timestamp('updated_at');

            //            $table->unique('device_id');
            $table->unique(['user_id','device_id']);
            Event::fire(static::$EVENT_CREATE_SCHEMA,$table);
        });
    }


}
