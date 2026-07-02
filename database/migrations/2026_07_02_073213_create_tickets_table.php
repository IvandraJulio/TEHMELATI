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
        Schema::create('tickets', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('pengirimId', 50);
            $table->string('pengirimName', 100);
            $table->string('jenis', 50);
            $table->string('layananKategori', 100);
            $table->string('layananSub', 100);
            $table->string('layanan', 100);
            $table->text('detail');
            $table->string('tanggal', 50);
            $table->string('tanggalUpdate', 50);
            $table->string('tanggalSelesai', 50)->nullable();
            $table->string('kasubbagId', 50)->nullable();
            $table->string('kasubbagName', 100)->nullable();
            $table->string('solverId', 50)->nullable();
            $table->string('solverName', 100)->nullable();
            $table->string('status', 50);
            $table->text('alasanTolak')->nullable();
            $table->text('catatanKasubbag')->nullable();
            $table->timestamps();

            $table->foreign('pengirimId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
