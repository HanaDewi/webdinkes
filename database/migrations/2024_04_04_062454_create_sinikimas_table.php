<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('sinikimas', function (Blueprint $table) {
            $table->id();
            $table->string('no')->nullable();
            $table->string('upaya_kesehatan')->nullable();
            $table->string('kegiatan')->nullable();
            $table->string('satuan')->nullable();
            $table->float('target_1')->nullable();
            $table->float('target_2')->nullable();
            $table->float('target_persen')->nullable();
            $table->float('target_des')->nullable();
            $table->float('pencapaian')->nullable();
            $table->string('cakupan')->nullable();
            $table->float('nilai')->nullable();
            $table->string('jenis_cakupan')->nullable();
            $table->string('jenis_indikator')->nullable();
            $table->string('jenis_subindikator')->nullable();
            $table->float('tahun')->nullable();
            $table->string('akun_puskesmas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('sinikimas');
    }
};
