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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('namaKelas', 50);
            $table->string('waliKelas', 50);
            $table->string('ketuaKelas', 50)->nullable(); // nullable jika tidak wajib
            $table->integer("kursi")->default(0);
            $table->integer("meja")->default(0);
            $table->string('gambar_kelas', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};