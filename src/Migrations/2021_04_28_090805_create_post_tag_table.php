<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('skijasi.database.prefix').'post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id');
            $table->foreignId('tag_id');
        });

        Schema::table(config('skijasi.database.prefix').'post_tag', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on(config('skijasi.database.prefix').'posts')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on(config('skijasi.database.prefix').'tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('skijasi.database.prefix').'post_tag');
    }
}
