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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('book_id');
            $table->enum('jenis', ['Kelas 10', 'Kelas 11', 'Kelas 12', 'Makalah', 'Lainnya']);
            $table->string('jumlah');
            $table->date('tanggal_peminjaman');
            $table->enum('status', ['Sudah Dikembalikan', 'Belum Dikembalikan']);
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('elibrary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
