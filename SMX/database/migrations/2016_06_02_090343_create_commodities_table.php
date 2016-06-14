<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommoditiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodities', function (Blueprint $table) {
            $table->increments('id');//编号
            $table->string('name');//名称
            $table->string('type');//型号
            $table->integer('number');//库存数量
            $table->double('avgin');//进价
            $table->double('avgout');//零售价
            $table->integer('numin');//进货数量
            $table->integer('numout');//售出数量
            $table->integer('lesswarn');
            $table->double('morewarn');
            $table->integer('category');//商品分类
            $table->integer('alarm');//报警数量
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
        Schema::drop('commodities');
    }
}
