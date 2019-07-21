<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_group_notification')->default(true);
            $table->integer('from_user_id')->unsigned();
            $table->integer('to_user_id')->unsigned()->nullable();
            $table->integer('to_role_id')->unsigned()->nullable();
            $table->string('message');
            $table->string('status', '50');
            $table->timestamps();
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign('from_user_id')
                ->references('id')->on('users');
            $table->foreign('to_user_id')
                ->references('id')->on('users');
            $table->foreign('to_role_id')
                ->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
