<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembercustompaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membercustompayments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->decimal('amount',18,3)->nullable();
            $table->year('year')->nullable();
            $table->decimal('amount_paid',18,3)->nullable();
            $table->integer('collection_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->foreign('collection_id')->references('id')->on('churchgivens')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::drop('membercustompayments');
    }
}
