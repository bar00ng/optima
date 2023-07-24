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
        Schema::create('go_live', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lop_id')->constrained('lop')->onDelete('cascade');
            $table->boolean('isNeed')->nullable()->default(null);
            $table->string('evidence_golive')->nullable()->default(null);
            $table->text('keterangan_withGolive')->nullable()->default(null);
            $table->text('keterangan_withoutGolive')->nullable()->default(null);
            $table->boolean('isApproved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('go_live');
    }
};
