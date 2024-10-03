<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->integer('likes')->nullable();
            $table->integer('dislikes')->nullable();
            $table->string('likeable_type', 255);
            $table->unsignedBigInteger('likeable_id');
            $table->timestamps();
            $table->foreign('likeable_id')->references('id')->on('articles')->onDelete('cascade');
            $table->index(['likeable_type', 'likeable_id'], 'index_likes_on_likeable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
