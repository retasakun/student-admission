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
        Schema::create('data_orang_tua', function (Blueprint $table) {
            $table->foreignUuid('akun_id')->constrained('akun')->onDelete('cascade');
            $table->enum('jenis', ['Ayah', 'Ibu', 'Wali']);
            $table->unique(['akun_id', 'jenis']);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir', 20);
            $table->text('alamat');
            $table->string('telp')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('RT_RW')->nullable();
            $table->decimal('penghasilan', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_orang_tuas');
    }
};
