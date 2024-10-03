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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->default('');
            $table->string('email', 255);
            $table->string('encrypted_password', 255)->default('');
            $table->string('reset_password_token', 255)->nullable();
            $table->dateTime('reset_password_sent_at')->nullable();
            $table->dateTime('remember_created_at')->nullable();
            $table->timestamps();
            $table->unique('email', 'index_users_on_email');
            $table->unique('reset_password_token', 'index_users_on_reset_password_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
