<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title', 30);
            $table->string('cover')->nullable();
            $table->string('label', 120);
            $table->date('release_date');
            $table->unsignedBigInteger('artist_id');
            $table->unsignedBigInteger('genre_id');

            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('albums');
    }
};
