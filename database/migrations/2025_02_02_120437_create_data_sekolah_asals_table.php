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
        Schema::create('data_sekolah_asal', function (Blueprint $table) {
            $table->foreignUuid('akun_id')->constrained('akun')->onDelete('cascade');
            $table->string('nama_sekolah_asal');
            $table->string('npsn', 15)->nullable();
            $table->string('nsm', 15)->nullable();
            $table->text('alamat');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_sekolah_asals');
    }
};
