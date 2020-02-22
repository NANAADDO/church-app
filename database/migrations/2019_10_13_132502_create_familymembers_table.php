<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFamilymembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familymembers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('relationship_id');
            $table->integer('marital_status_id')->nullable();
            $table->string('marriage_type_id')->nullable();
            $table->string('marriage_place')->nullable();
            $table->date('date')->nullable();
            $table->string('rev_minister')->nullable();
            $table->string('church_id')->nullable();
            $table->integer('member_id')->unsigned();
            $table->string('office')->nullable();
            $table->string('residence')->nullable();
            $table->integer('locality_id')->nullable();
            $table->foreign('relationship_id')->references('id')->on('relationship')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::drop('familymembers');
    }
}
