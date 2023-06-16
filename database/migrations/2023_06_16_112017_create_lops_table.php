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
        Schema::create('lop', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permintaan_id')->constrained('list_permintaan')->delete('cascade');
            $table->string('nama_lop');
            $table->string('tematik_lop');
            $table->string('estimasi_rab');
            $table->string('sto');
            $table->string('tikor_lop');
            $table->string('lokasi_lop');
            $table->text('keterangan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lops');
    }
};
