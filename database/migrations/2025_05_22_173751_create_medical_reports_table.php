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
        Schema::create('medical_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultation_id')->constrained('consultations')->onDelete('cascade');
            $table->string('report_file');
            $table->text('complaint')->nullable(); // Keluhan pasien
            $table->foreignId('prescription_id')->nullable()->constrained('prescriptions')->onDelete('set null'); // Relasi dengan tabel prescriptions
            $table->text('examination_result')->nullable(); // Hasil pemeriksaan
            $table->string('follow_up_status')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_reports');
    }
};
