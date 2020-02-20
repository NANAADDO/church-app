<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTextmessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('textmessages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('content')->nullable();
            $table->string('title','150')->nullable();

            $table->integer('total_characters')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('branch_id');
            $table->integer('sms_qty')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('restrict')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('textmessages');
    }
}
