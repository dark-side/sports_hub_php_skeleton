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
        Schema::create('active_storage_blobs', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('filename');
            $table->string('content_type')->nullable();
            $table->text('metadata')->nullable();
            $table->string('service_name');
            $table->unsignedBigInteger('byte_size');
            $table->string('checksum')->nullable();
            $table->timestamps();

            $table->index('key', 'index_active_storage_blobs_on_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_storage_blobs');
    }
};
