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
        Schema::create('selesai_fisik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lop_id')->constrained('lop')->onDelete('cascade');
            $table->text('keterangan_selesai')->nullable();
            $table->boolean('isApproved')->nullable();
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selesai_fisik');
    }
};
