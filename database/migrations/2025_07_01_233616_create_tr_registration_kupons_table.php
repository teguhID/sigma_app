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
        Schema::create('tr_registration_kupon', function (Blueprint $table) {
            $table->bigIncrements('id_registration_kupon');
            $table->string('id_user_registration');
            $table->unsignedBigInteger('id_kode_kupon');
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->foreign('id_user_registration')->references('id_user_registration')->on('tr_user_registration');
            $table->foreign('id_kode_kupon')->references('id_kode_kupon')->on('m_kode_kupon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_registration_kupon');
    }
};
