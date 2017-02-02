<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('notices_labels_id');  //外键
            $table->string('title', 64);
            $table->text('content');
            $table->boolean('status')->default(true);  //是否可见
            $table->integer('order')->default(1);  //排序规则
            $table->timestamps();
            $table->foreign('notices_labels_id')->references('id')->on('notices_labels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notices');
    }
}
