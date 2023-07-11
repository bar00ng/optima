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
        Schema::create('persiapan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lop_id')->constrained('lop')->onDelete('cascade');
            $table->text('keterangan_persiapan')->nullable();
            $table->integer('persiapan_progress')->default(0);
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persiapan');
    }
};
