<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBirthdaynotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birthdaynotifications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('message_id');
            $table->unsignedInteger('tag_id');
            $table->string('state_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('branch_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('message_id')->references('id')->on('textmessages')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('tag_id')->references('id')->on('messagetags')->onDelete('restrict')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('birthdaynotifications');
    }
}
