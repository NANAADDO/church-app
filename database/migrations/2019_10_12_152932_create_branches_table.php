<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name')->nullable();
            $table->string('location')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_numbers')->nullable();
            $table->foreign('region_id')->references('id')->on('region')->onUpdate('cascade')
                ->onDelete('restrict');

        });

        Schema::table('branches', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')
                ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('branches');
    }
}
