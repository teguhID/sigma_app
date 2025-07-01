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
        Schema::create('tr_user_registration', function (Blueprint $table) {
            $table->id('id_user_registration');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_user_profile');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_program');
            $table->unsignedBigInteger('id_sub_program')->nullable();
            $table->unsignedBigInteger('id_program_duration');
            $table->unsignedBigInteger('id_status_bayar');
            $table->string('kode_voucher', 50)->nullable();
            $table->decimal('total_biaya', 12, 2);
            $table->timestamp('payment_deadline')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            // Foreign keys
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_user_profile')->references('id_user_profile')->on('m_user_profile');
            $table->foreign('id_kelas')->references('id_kelas')->on('m_kelas');
            $table->foreign('id_program')->references('id_program')->on('m_program');
            $table->foreign('id_sub_program')->references('id_sub_program')->on('m_sub_program');
            $table->foreign('id_program_duration')->references('id_program_duration')->on('m_program_duration');
            $table->foreign('id_status_bayar')->references('id_status_bayar')->on('m_status_bayar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_user_registrations');
    }
};
