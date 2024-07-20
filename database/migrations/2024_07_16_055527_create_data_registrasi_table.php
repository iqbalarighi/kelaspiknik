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
        Schema::create('data_registrasi', function (Blueprint $table) {
            $table->id();
            $table->string('id_reg', 20)->unique();
            $table->string('sekolah');
            $table->string('nama_lengkap');
            $table->string('kelas');
            $table->string('nis');
            $table->string('ttl');
            $table->string('email');
            $table->text('alamat');
            $table->text('penyakit');
            $table->string('no_tel');
            $table->string('no_wa');
            $table->text('foto');
            $table->string('nm_ortu');
            $table->string('no_tel_ortu1');
            $table->string('no_tel_ortu2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_registrasi');
    }
};
