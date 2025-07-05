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
        Schema::create('m_kode_kupon', function (Blueprint $table) {
            $table->bigIncrements('id_kode_kupon');
            $table->char('name', 255);
            $table->char('kode', 255);
            $table->integer('persentase_diskon');
            $table->text('desc')->nullable();
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_kode_kupon');
    }
};
