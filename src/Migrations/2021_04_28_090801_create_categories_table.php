<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('skijasi.database.prefix').'categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable();
            $table->string('title', 255);
            $table->string('meta_title', 255)->nullable();
            $table->string('slug', 255)->unique();
            $table->text('content')->nullable();
            $table->timestamps();
        });

        Schema::table(config('skijasi.database.prefix').'categories', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on(config('skijasi.database.prefix').'categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('skijasi.database.prefix').'categories');
    }
}
