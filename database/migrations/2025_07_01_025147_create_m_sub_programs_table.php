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
        Schema::create('m_sub_program', function (Blueprint $table) {
            $table->bigIncrements('id_sub_program'); // Primary key
            $table->unsignedBigInteger('id_program'); // FK ke m_program
            $table->char('name', 255);
            $table->text('desc')->nullable();
            $table->timestamps(); // created_at & updated_at otomatis
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            // Tambahkan foreign key constraint
            $table->foreign('id_program')->references('id_program')->on('m_program')->onDelete('cascade'); // jika program dihapus, sub-program ikut terhapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_sub_program');
    }
};
