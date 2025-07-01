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
        Schema::create('m_user_profile', function (Blueprint $table) {
            $table->id('id_user_profile');
            $table->unsignedBigInteger('id_user');
            $table->string('nama', 100);
            $table->text('jurusan_kampus_favorit')->comment('Format: "Jurusan - Kampus" contoh: "Teknik Informatika - ITB"');
            $table->string('jam_belajar_favorit', 100);
            $table->string('sosmed', 100)->nullable();
            $table->string('no_wa', 20);
            $table->string('nama_akun_zoom', 100);
            $table->string('email', 100);
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            // Foreign keys
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_user_profile');
    }
};
