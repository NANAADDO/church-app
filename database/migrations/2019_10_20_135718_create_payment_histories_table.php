<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->decimal('amount_paid',18,2)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->integer('member_id')->unsigned();
            $table->date('date_paid')->nullable();
            $table->integer('collection_id')->unsigned();
            $table->integer('point_id')->unsigned();
            $table->integer('point_sub_id')->nullable();
            $table->foreign('collection_id')->references('id')->on('churchgivens')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('member_id')->references('id')->on('memberdetails')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('point_id')->references('id')->on('paymentpoints')->onDelete('restrict')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payment_histories');
    }
}
