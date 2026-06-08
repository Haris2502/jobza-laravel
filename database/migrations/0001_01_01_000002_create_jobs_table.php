<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');

            $table->string('thumbnail')->nullable();

            // UBAH DI SINI: Menggunakan tipe json/text agar bisa menampung banyak foto sekaligus
            $table->json('image_url')->nullable();

            $table->enum('category', ['lowongan', 'freelance']);
            $table->enum('status', ['open', 'closed'])->default('open');

            $table->string('salary')->nullable();
            $table->string('location')->nullable();
            $table->string('admin_phone')->nullable();

            $table->foreignId('created_by')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();

            // index
            $table->index('category');
            $table->index('created_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
