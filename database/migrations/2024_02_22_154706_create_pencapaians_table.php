<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('pencapaians', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('program')->nullable();
            $table->string('indikator_kinerja')->nullable();
            $table->string('tipe')->nullable();
            $table->float('target')->nullable();
            $table->float('realisasi_januari')->nullable();
            $table->float('realisasi_februari')->nullable();
            $table->float('realisasi_maret')->nullable();
            $table->float('realisasi_april')->nullable();
            $table->float('realisasi_mei')->nullable();
            $table->float('realisasi_juni')->nullable();
            $table->float('realisasi_juli')->nullable();
            $table->float('realisasi_agustus')->nullable();
            $table->float('realisasi_september')->nullable();
            $table->float('realisasi_oktober')->nullable();
            $table->float('realisasi_november')->nullable();
            $table->float('realisasi_desember')->nullable();
            $table->float('realisasi_akhir')->nullable();
            $table->string('catatan')->nullable();
            $table->string('tahun')->nullable();
            $table->string('keg')->nullable();
            $table->string('apbd')->nullable();
            $table->string('komentar')->nullable();
            $table->string('bidang')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('pencapaians');
    }
};

