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
            $table->foreignId('permintaan_id')->constrained('list_permintaan')->onDelete('cascade');
            $table->date('tanggal_permintaan')->default(now());
            $table->string('nama_lop')->nullable()->default(null);
            $table->string('tematik_lop')->nullable()->default(null);
            $table->string('estimasi_rab')->nullable()->default(null);
            $table->string('sto')->nullable()->default(null);
            $table->string('longitude')->nullable()->default(null);
            $table->string('latitude')->nullable()->default(null);
            $table->string('lokasi_lop')->nullable()->default(null);
            $table->text('keterangan_lop');
            $table->string('rab_ondesk')->nullable()->default(null);
            $table->string('keterangan_rab')->nullable()->default(null);
            $table->foreignId('mitra_id')->nullable()->constrained('user')->onDelete('cascade');
            $table->string('tipe_professioning')->nullable()->default(null);
            $table->string('status')->nullable()->default(null);
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
