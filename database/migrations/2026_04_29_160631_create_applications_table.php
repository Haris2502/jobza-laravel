<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            // Relasi ke User (Siapa yang melamar)
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Relasi ke Job (Pekerjaan apa yang dilamar)
            $table->foreignId('job_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Data Tambahan dari Form di Flutter
            $table->string('name'); // Nama lengkap pelamar
            $table->string('cv_url'); // Link Portofolio / CV dari Drive
            $table->text('message')->nullable(); // Pesan tambahan dari pelamar (opsional)

            // Status Lamaran
            $table->enum('status', ['pending', 'accepted', 'rejected'])
                  ->default('pending');

            $table->timestamps();

            // Biar user tidak bisa melamar di pekerjaan yang sama dua kali
            $table->unique(['user_id', 'job_id']);

            // Index untuk mempercepat pencarian oleh admin
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
