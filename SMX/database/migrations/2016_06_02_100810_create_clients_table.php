<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('level');
            $table->string('name');
            $table->string('tel');
            $table->string('address');
            $table->double('limit');//应收额度
            $table->double('in');//应收
            $table->double('out');//应付
            $table->double('overall');//历史付款总额
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
        Schema::drop('clients');
    }
}
