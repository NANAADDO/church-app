<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBirthdaySchedulehistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birthdayschedulehistory', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('total')->nullable();
            $table->date('date_in_year')->nullable();
            $table->dateTime('last_member_date_scheduled');
            $table->integer('user_id');
            $table->integer('branch_id');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('birthdayschedulehistory');
    }
}
