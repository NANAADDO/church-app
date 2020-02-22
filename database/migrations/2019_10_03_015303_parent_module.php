<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParentModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_module', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('action_type')->nullable();
            $table->string('path_name')->nullable();
            $table->string('aliases')->nullable();
            $table->unsignedInteger('group_type_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('group_type_id')->references('id')->on('group_type')->onUpdate('cascade')
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
        //
    }
}
