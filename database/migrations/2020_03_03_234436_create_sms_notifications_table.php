<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSmsNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('quantity')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('notification_state')->nullable();
            $table->integer('user_id')->nullable();
            $table->date('notification_date')->nullable();

            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sms_notifications');
    }
}
