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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users (Foreign Key)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Kolom avatar untuk menyimpan path foto profil (nullable karena di UI bisa pakai placeholder dulu)
            $table->string('avatar')->nullable();

            // Kolom nomor telepon (menggunakan string untuk mengakomodasi karakter '+' atau '0' di depan)
            $table->string('phone_number', 20)->nullable();

            // Kolom bio untuk bagian "TENTANG SAYA" di UI (menggunakan text agar muat deskripsi panjang)
            $table->text('bio')->nullable();

            // Kolom opsional tambahan untuk CV/Resume dan Pendidikan
            $table->string('resume_url')->nullable();
            $table->string('education')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
