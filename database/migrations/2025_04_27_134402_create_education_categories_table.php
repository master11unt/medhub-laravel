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
        Schema::create('education_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // contoh: Tips sehat
            $table->string('icon')->nullable();  // simpan nama icon atau path SVG/iconnya
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_categories');
    }
};
