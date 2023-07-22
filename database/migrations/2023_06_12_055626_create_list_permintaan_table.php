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
        Schema::create('list_permintaan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_permintaan');
            $table->string('tematik_permintaan');
            $table->string('no_nota_dinas')->nullable()->default(null);
            $table->string('refferal_permintaan')->nullable()->default(null);
            $table->string('nama_permintaan');
            $table->string('pic_permintaan');
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
        Schema::dropIfExists('list_permintaans');
    }
};
