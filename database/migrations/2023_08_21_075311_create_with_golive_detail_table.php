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
        Schema::create('with_golive_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('with_golive_id')->constrained('with_go_live')->onDelete('cascade');
            $table->string('evidence_name');
            $table->boolean('isApproved')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('with_golive_detail');
    }
};
