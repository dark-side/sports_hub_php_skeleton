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
        Schema::create('active_storage_variant_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blob_id');
            $table->string('variation_digest');
            $table->timestamps();

            $table->unique(['blob_id', 'variation_digest'], 'index_active_storage_variant_records_uniqueness');
            $table->foreign('blob_id')->references('id')->on('active_storage_blobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_storage_variant_records');
    }
};
