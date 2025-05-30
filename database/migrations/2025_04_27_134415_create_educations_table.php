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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable(); // untuk artikel
            $table->enum('type', ['artikel', 'video']);            
            $table->string('thumbnail')->nullable(); // path gambar
            $table->string('source');
            $table->string('institution_logo')->nullable();
            $table->string('author_name')->nullable();
            $table->dateTime('published_at');
            $table->string('video_url')->nullable(); // kalau video
            $table->string('share_link')->nullable(); // Link share untuk artikel
            $table->foreignId('education_category_id')->constrained('education_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
