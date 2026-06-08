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
        Schema::create('admin_profiles', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users (Foreign Key)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Kolom penunjang profil Perusahaan / Admin Pemberi Kerja
            $table->string('company_name')->nullable(); // Nama Perusahaan/Instansi
            $table->string('company_logo')->nullable(); // Path logo instansi
            $table->string('company_website')->nullable(); // Link website perusahaan
            $table->string('industry_type')->nullable(); // Bidang industri (IT, Keuangan, dll)
            $table->text('company_description')->nullable(); // Deskripsi/Profil singkat perusahaan
            $table->string('office_address')->nullable(); // Lokasi kantor fisik

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_profiles');
    }
};
