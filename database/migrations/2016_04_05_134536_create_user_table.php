<?php

use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create($this->getTable(), function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('user_id');
            $table->string('username')->nullable()->default(null);
            $table->string('nickname')->default('');
            $table->string('avatar',1000)->default('');
            $table->string('sns_id')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('mobile')->nullable()->default(null);
            $table->string('qq')->nullable()->default(null);
            $table->string('password', 128)->nullable()->default(null);
            $table->rememberToken();
            $table->timestamp('created_at')->default(new Expression('current_timestamp'));
            $table->timestamp('updated_at');

            $table->unique('user_id');
            $table->unique('username');
            $table->unique('email');
            $table->unique('mobile');
            $table->unique('qq');

            Event::fire(static::$EVENT_CREATE_SCHEMA,$table);
        });
    }
}
