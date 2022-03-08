<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_episodes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('episode_title');
            $table->longText('episode_description');
            $table->string('episode_video');
            $table->boolean('isApproved')->default(false);
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
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
        Schema::dropIfExists('course_episodes');
    }
}
