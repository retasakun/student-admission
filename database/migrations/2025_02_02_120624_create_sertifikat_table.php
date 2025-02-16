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
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->foreignUuid('akun_id')->references("id")->on('akun')->onDelete('cascade');
            $table->boolean('utama');
            $table->string('judul');
            $table->text('desc')->nullable();
            $table->string('tingkat');
            $table->string('sebagai');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
    }
};
