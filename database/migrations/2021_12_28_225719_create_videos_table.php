<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id("video_id");
            $table->string("video_title");
            $table->string("video_path");
            $table->integer("video_duration_minutes");
            $table->integer("video_duration_secondes");
            $table->string("video_image_background");
            $table->unsignedBigInteger("course_id");
            $table->foreign("course_id")->references("course_id")->on("courses");
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
        Schema::dropIfExists('videos');
    }
}
