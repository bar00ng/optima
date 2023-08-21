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
        Schema::create('with_go_live', function (Blueprint $table) {
            $table->id();
            $table->foreignId('go_live_id')->constrained('go_live')->onDelete('cascade');
            $table->string('keterangan_golive')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('with_go_live');
    }
};
