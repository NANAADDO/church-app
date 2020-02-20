<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberchurchgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberchurchgroups', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->integer('groups_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->foreign('groups_id')->references('id')->on('churchgroups')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::drop('memberchurchgroups');
    }
}
