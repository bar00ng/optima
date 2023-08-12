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
            $table->string('nama_lop')->default('');
            $table->string('tematik_lop')->default('');
            $table->string('estimasi_rab')->nullable()->default(null);
            $table->string('sto')->default('');
            $table->string('longitude')->default('');
            $table->string('latitude')->default('');
            $table->string('lokasi_lop')->default('');
            $table->text('keterangan_lop');
            $table->string('rab_ondesk')->default('');
            $table->string('keterangan_rab')->default('');
            $table->foreignId('mitra_id')->nullable()->constrained('user')->onDelete('cascade');
            $table->string('tipe_professioning')->nullable()->default(null);
            $table->string('status')->default('');
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
