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
        Schema::create('tbl_sinikimas_pkp', function (Blueprint $table) {
    $table->id();
    $table->string('upaya_kesehatan')->nullable();
    $table->string('kegiatan')->nullable();
    $table->string('satuan')->nullable();
    $table->float('target_1')->nullable();
    $table->float('target_2')->nullable();
    $table->float('target_persen')->nullable();
    $table->text('target_des')->nullable();
    $table->float('pencapaian')->nullable();
    $table->text('jenis_cakupan')->nullable();
    $table->text('jenis_indikator')->nullable();
    $table->text('jenis_subindikator')->nullable();
    $table->text('total_cakupan')->nullable();
    $table->text('total_indikator')->nullable();
    $table->text('total_subindikator')->nullable();
    $table->text('cakupan')->nullable();
    $table->float('sub_variabel')->nullable();
    $table->float('nilai')->nullable();
    $table->float('tahun')->nullable();
    $table->float('bulan')->nullable();
    $table->float('tanggal')->nullable();
    $table->text('akun_puskesmas')->nullable();
    $table->text('komentar')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sinikimas_pkp');
    }
};
