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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama obat
            $table->decimal('price', 10, 2); // Harga obat
            $table->text('description'); // Deskripsi obat
            $table->text('composition'); // Komposisi obat
            $table->string('packaging'); // Kemasan obat
            $table->text('benefits'); // Manfaat/Kegunaan obat
            $table->string('category'); // Kategori obat
            $table->string('dose'); // Dosis obat
            $table->string('presentation'); // Penyajian obat
            $table->string('storage'); // Cara penyimpanan obat
            $table->text('attention'); // Perhatian obat
            $table->text('side_effects'); // Efek samping obat
            $table->string('mims_standard_name'); // Nama standar MIMS
            $table->string('registration_number')->unique(); // Nomor izin edar obat
            $table->string('drug_class'); // Golongan obat
            $table->text('remarks')->nullable(); // Keterangan obat
            $table->string('reference'); // Referensi obat
            $table->string('k24_url'); // URL di K24
            $table->boolean('is_prescription')->default(false); // Obat keras atau tidak (boolean)
            $table->string('image')->nullable(); // Gambar obat (URL atau path)
            $table->string('share_link')->nullable();  // Link share untuk obat (contoh: K24 URL)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
