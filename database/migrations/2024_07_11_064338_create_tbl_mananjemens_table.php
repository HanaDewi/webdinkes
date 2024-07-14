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
        Schema::create('tbl_manajemens', function (Blueprint $table) {
            $table->id();
            $table->string('indikator')->nullable();
            $table->string('sub_indikator')->nullable();
            $table->string('jenis_variabel')->nullable();
            $table->text('nilai_0')->nullable();
            $table->text('nilai_4')->nullable();
            $table->text('nilai_7')->nullable();
            $table->text('nilai_10')->nullable();
            $table->float('nilai_hasil')->nullable();
            $table->string('akun_puskesmas')->nullable();
            $table->float('tahun')->nullable();
            $table->float('bulan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_mananjemens');
    }
};
