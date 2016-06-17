<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exports', function (Blueprint $table) {
            $table->increments('id');//单据编号
            $table->integer('status');//状态
            $table->integer('type');//单据类型:1销售0销售退货
            $table->integer('clientid');//销售商id
            $table->string('clientname');//销售商名字
            $table->integer('operatorid');//操作员id
            $table->string('operatorname');//操作员名字
            $table->integer('commodityid');//商品编号
            $table->integer('number');//数量
            $table->double('discount');//折让金额(依据客户等级)
            $table->double('initoverall');//初始总额合计
            $table->double('overall');//折后总价
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
        Schema::drop('exports');
    }
}
