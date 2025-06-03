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
        Schema::create('registrants', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 100); 
            $table->date('birth_date'); 
            $table->enum('gender', ['Laki-Laki', 'Perempuan']); 
            $table->text('address'); 
            $table->string('phone_number', 20); 
            $table->string('identity_number', 30)->nullable(); 
            $table->text('special_notes')->nullable(); 
            $table->enum('has_medical_history', ['Ya', 'Tidak']);
            $table->boolean('agreement')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrants');
    }
};
