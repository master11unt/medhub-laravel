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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');            
            // $table->foreignId('specialization_id')->constrained('specializations')->onDelete('cascade');
            $table->string('specialization');        
            $table->string('education')->nullable();
            $table->string('practice_place')->nullable();
            $table->string('description')->nullable();
            $table->string('license_number')->unique();
            $table->boolean('is_specialist')->default(false); // false berarti umum, true berarti spesialis
            $table->boolean('is_online')->default(false);  // false untuk offline, true untuk online
            $table->boolean('is_in_consultation')->default(false);  // false untuk tidak konsultasi, true untuk konsultasi
            $table->decimal('average_rating', 3, 2)->default(0); // Nilai rata-rata rating dokter
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
