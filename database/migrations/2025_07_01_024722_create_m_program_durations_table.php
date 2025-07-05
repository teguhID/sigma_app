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
        Schema::create('m_program_duration', function (Blueprint $table) {
            $table->bigIncrements('id_program_duration'); // primary key auto increment
            $table->char('name', 255);
            $table->text('desc')->nullable();
            $table->timestamps(); // created_at & updated_at otomatis
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_program_duration');
    }
};
