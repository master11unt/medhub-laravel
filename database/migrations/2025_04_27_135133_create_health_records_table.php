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
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->integer('height')->nullable(); // Tinggi badan (cm)
            $table->integer('weight')->nullable(); // Berat badan (kg)
            $table->string('blood_type', 5)->nullable(); // Golongan darah (misal: A, B, AB, O)
            $table->date('birth_date')->nullable(); // Tanggal lahir
            $table->integer('age')->nullable(); // Umur
            $table->text('allergies')->nullable(); // Alergi
            $table->text('current_medications')->nullable(); // Obat yang sedang dikonsumsi
            $table->text('current_conditions')->nullable(); // Kondisi saat ini
            $table->string('medical_document')->nullable(); // Path dokumen medis (pdf atau gambar)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
