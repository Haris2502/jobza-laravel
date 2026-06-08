    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('reels', function (Blueprint $table) {
                $table->id();

                $table->string('title');
                $table->text('description');

                // Bagian Media: Menggunakan video dan thumbnail video
                $table->string('video_url')->nullable();      // File video reels (.mp4, .mov, dll)
                $table->string('thumbnail_url')->nullable();  // Gambar cover/poster sebelum video diputar

                // Samakan enum, status, dan data pelengkap dengan tabel jobs
                $table->enum('category', ['lowongan', 'freelance']);
                $table->enum('status', ['open', 'closed'])->default('open');

                $table->string('salary')->nullable();
                $table->string('location')->nullable();
                $table->string('admin_phone')->nullable();    // Nomor WA Admin untuk Apply dari Reels

                // FITUR BARU: Menyimpan daftar ID User yang Like & Save dalam bentuk JSON
                $table->json('liked_by')->default(new \Illuminate\Database\Query\Expression('(JSON_ARRAY())'));
                $table->json('saved_by')->default(new \Illuminate\Database\Query\Expression('(JSON_ARRAY())'));

                // Relasi ke tabel users (siapa yang membuat Reels ini)
                $table->foreignId('created_by')
                    ->constrained('users')
                    ->cascadeOnDelete();

                $table->timestamps();
                $table->softDeletes(); // Mengaktifkan soft deletes agar sama dengan jobs

                // Indexing untuk mempercepat query database
                $table->index('category');
                $table->index('created_by');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('reels');
        }
    };
