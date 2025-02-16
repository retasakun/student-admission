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
        Schema::create('akun', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('telepon');
            $table->string('password');
            $table->rememberToken();
            $table->string('peminatan')->nullable();
            $table->string('kualifikasi')->nullable();
            $table->boolean('is_lolos_berkas')->nullable()->default(null);
            $table->text('pesan_status_berkas')->nullable();
            $table->boolean('is_lolos_ujian')->nullable()->default(null);
            $table->text('pesan_status_ujian')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->datetime('submited')->nullable();
            $table->text('bukti')->nullable();
            $table->text('formulir')->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
