<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('depositor_id')->unsigned();
            $table->double('amount');
            $table->date('deposit_date');
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('deposits', function (Blueprint $table) {
            $table->foreign('depositor_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposits');
    }
}
