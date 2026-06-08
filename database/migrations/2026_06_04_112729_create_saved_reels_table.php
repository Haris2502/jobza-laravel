<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('saved_reels', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('reel_id')->constrained('reels')->onDelete('cascade'); // pastikan nama tabel reels kamu 'reels'
        $table->timestamps();

        // Mencegah duplikasi data yang sama
        $table->unique(['user_id', 'reel_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_reels');
    }
};
