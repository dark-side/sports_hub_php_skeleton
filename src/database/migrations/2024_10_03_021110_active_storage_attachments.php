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
        Schema::create('active_storage_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('record_type');
            $table->unsignedBigInteger('record_id');
            $table->unsignedBigInteger('blob_id');
            $table->timestamps();

            $table->index(['record_type', 'record_id', 'name', 'blob_id'], 'index_active_storage_attachments_uniqueness');
            $table->foreign('blob_id')->references('id')->on('active_storage_blobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_storage_attachments');
    }
};
