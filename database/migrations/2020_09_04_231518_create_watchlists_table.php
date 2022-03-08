<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWatchlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watchlists', function (Blueprint $table) {
            
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('episode_id')->constrained('course_episodes')->onDelete('cascade');
                $table->timestamps();
    
                //SETTING THE PRIMARY KEYS
                $table->primary(['user_id','episode_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('watchlists');
    }
}
