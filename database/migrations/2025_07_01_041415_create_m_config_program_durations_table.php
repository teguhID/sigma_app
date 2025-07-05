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
        Schema::create('m_config_program_duration', function (Blueprint $table) {
            $table->bigIncrements('id_config_program_duration'); // Primary key
            $table->unsignedBigInteger('id_program'); // FK ke m_program
            $table->unsignedBigInteger('id_sub_program')->nullable(); // FK ke m_sub_program
            $table->unsignedBigInteger('id_program_duration'); // FK ke m_program_duration
            $table->integer('harga')->default(0);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps(); // created_at & updated_at otomatis
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->foreign('id_program')->references('id_program')->on('m_program')->onDelete('cascade');
            $table->foreign('id_sub_program')->references('id_sub_program')->on('m_sub_program')->onDelete('set null'); // jika sub program dihapus, set null
            $table->foreign('id_program_duration')->references('id_program_duration')->on('m_program_duration')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_config_program_duration');
    }
};
