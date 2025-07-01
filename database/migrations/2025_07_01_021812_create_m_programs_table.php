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
        Schema::create('m_program', function (Blueprint $table) {
            $table->bigIncrements('id_program'); // primary key auto increment
            $table->char('name', 255);
            $table->text('desc')->nullable();
            $table->timestamps(); // created_at & updated_at otomatis
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_program');
    }
};
