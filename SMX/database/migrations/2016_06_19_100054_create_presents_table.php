<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('start');//开始时间
            $table->string('end');//结束时间
            $table->integer('level');//客户等级
            $table->integer('commodityfirst');//赠品1id
            $table->integer('numfirst');//赠品1数量
            $table->integer('commoditysecond');//赠品2id
            $table->integer('numsecond');//赠品2数量
            $table->integer('condition');//满赠金额
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
        Schema::drop('presents');
    }
}
