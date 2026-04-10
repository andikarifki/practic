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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke pendaftaran dan pasien
            $table->foreignId('pendaftaran_id')->constrained()->onDelete('cascade');
            $table->foreignId('pasien_id')->constrained();

            // Data Klinis Khusus Jiwa
            $table->string('diagnosa'); // Misal: F20 (Skizofrenia)
            $table->text('obat'); // Resep psikofarmaka
            $table->text('catatan_dokter')->nullable(); // Observasi perilaku
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
