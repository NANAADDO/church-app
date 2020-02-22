<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('surname')->nullable();
            $table->string('other_names')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('old_member_id')->nullable();
            $table->string('new_member_id')->nullable();
            $table->integer('branch_id')->unsigned();
            $table->date('date_of_birth')->nullable();
            $table->integer('nationality_id')->nullable();
            $table->integer('title_id')->nullable();
            $table->integer('hometown_id');
            $table->string('address')->nullable();
            $table->string('house_number')->nullable();
            $table->string('street_name')->nullable();
            $table->integer('locality_id')->nullable();
            $table->integer('gender_id')->nullable();
            $table->string('phone_numbers')->nullable();
            $table->string('email')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('nationality_id')->references('id')->on('countries')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('title_id')->references('id')->on('title')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('hometown_id')->references('id')->on('hometown')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('locality_id')->references('id')->on('locality')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('gender_id')->references('id')->on('gender')->onDelete('restrict')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('memberdetails');
    }
}
