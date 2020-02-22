<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReligiousproflesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('religiousprofiles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('are_you_baptised');
            $table->string('baptism_place')->nullable();
            $table->date('baptism_date')->nullable();
            $table->string('baptism_rev_minister')->nullable();
            $table->string('confirmation_place')->nullable();
            $table->date('confirmation_date')->nullable();
            $table->string('confirmation_rev_minister')->nullable();
            $table->integer('are_you_a_communicant');
            $table->string('reason_why_not_a_communicant')->nullable();
            $table->integer('are_you_a_convert');
            $table->integer('member_id')->unsigned();
            $table->string('prev_religious_denomination')->nullable();
            $table->date('date_converted')->nullable();
            $table->string('convert_rev_minister')->nullable();
            $table->foreign('are_you_baptised')->references('id')->on('question_option')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('are_you_a_communicant')->references('id')->on('question_option')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('are_you_a_convert')->references('id')->on('question_option')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('member_id')->references('id')->on('memberdetails')->onDelete('restrict')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('religiousprofiles');
    }
}
