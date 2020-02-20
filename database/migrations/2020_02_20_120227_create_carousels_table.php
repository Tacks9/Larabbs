<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousels', function (Blueprint $table) {
            // 递增的 ID (主键)，相当于「UNSIGNED INTEGER」
            $table->increments('id')->comment('轮播图id');
            $table->string('title')->default('轮播图')->comment('轮播图标题');
            $table->string('image')->comment('轮播图片');
            $table->string('link')->nullable()->comment('轮播图链接');
            $table->mediumInteger('status')->default(1)->comment('状态 1显示 0取消');
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
        Schema::dropIfExists('carousels');
    }
}
