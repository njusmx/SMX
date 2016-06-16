<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockreportformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockreportfroms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('commodity');
            $table->string('type');
            $table->integer('diff');
            $table->string('creator');
            $table->integer('status');//待审批0
            $table->integer('loss');//报溢0?报损1
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stockreportfroms');
    }
}
