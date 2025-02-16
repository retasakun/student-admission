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
        Schema::create('rapor', function (Blueprint $table) {
            $table->foreignUuid('akun_id')->constrained('akun')->onDelete('cascade');
            $table->json('nilai_sem1')->nullable();
            $table->text('file_sem1')->nullable();
            $table->json('nilai_sem2')->nullable();
            $table->text('file_sem2')->nullable();
            $table->json('nilai_sem3')->nullable();
            $table->text('file_sem3')->nullable();
            $table->json('nilai_sem4')->nullable();
            $table->text('file_sem4')->nullable();
            $table->json('nilai_sem5')->nullable();
            $table->text('file_sem5')->nullable();
            $table->text('file_rekap')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapors');
    }
};
