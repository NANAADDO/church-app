<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChurchcustompaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('churchcustompayments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->decimal('amount',18,2)->nullable();
            $table->date('year')->nullable();
            $table->date('start_end')->nullable();
            $table->integer('collection_id')->unsigned();
            $table->date('end_date')->nullable();
            $table->foreign('collection_id')->references('id')->on('churchgivens')->onDelete('restrict')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('churchcustompayments');
    }
}
