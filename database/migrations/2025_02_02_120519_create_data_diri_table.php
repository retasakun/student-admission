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
        Schema::create('data_diri', function (Blueprint $table) {
            $table->foreignUuid('akun_id')->constrained('akun')->onDelete('cascade');
            $table->string('foto')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('nisn', 10)->unique()->nullable();
            $table->text('ss_nisn')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('tanggal_lahir', 20)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->integer('jumlah_saudara')->nullable();
            $table->string('cita_cita')->nullable();
            $table->boolean('buta_warna')->nullable();
            $table->boolean('berkebutuhan_khusus')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('RT_RW', 7)->nullable();
            $table->string('kabupaten', 255)->nullable();
            $table->text('telp')->nullable();
            $table->text('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_diri');
    }
};
