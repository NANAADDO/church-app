<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->decimal('amount',18,2)->nullable();
            $table->decimal('expected_amount',18,2)->nullable();
            $table->integer('expected_people')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->integer('member_id')->unsigned();
            $table->date('date')->nullable();
            $table->date('funeral_date')->nullable();
            $table->integer('txt_state_id')->nullable();
            $table->string('description')->nullable();
            $table->foreign('member_id')->references('id')->on('memberdetails')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transports');
    }
}
