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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade'); // Relasi ke tabel doctors
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade'); // Relasi ke pasien (user)
            $table->tinyInteger('rating')->unsigned();  // Rating berupa angka, bisa 1-5 misalnya
            // $table->text('comment')->nullable(); // Komentar opsional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
