<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('tag_id')->comment('标签id'); // 标签id
            $table->unsignedBigInteger('topic_id')->comment('帖子id'); // 帖子id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags_topics');
    }
}
