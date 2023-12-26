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
        Schema::create('elibrary', function (Blueprint $table) {
            $table->id();
            $table->string('nama_buku');
            $table->string('penulis')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('foto_buku');
            $table->enum('jenis_buku', ['Kelas 10', 'Kelas 11', 'Kelas 12', 'Makalah', 'Lainnya']);
            $table->string('jumlah_buku')->nullable();
            $table->string('deskripsi');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elibrary');
    }
};
