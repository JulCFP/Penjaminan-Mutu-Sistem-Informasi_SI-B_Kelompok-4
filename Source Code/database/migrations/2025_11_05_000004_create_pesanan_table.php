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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->unsignedBigInteger('id_konsumen');
            $table->date('tanggal_pesan');
            $table->decimal('total_harga', 10, 2)->default(0.00);
            $table->string('status_pesanan', 50)->default('Menunggu Pembayaran');
            $table->text('alamat_pengiriman')->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_konsumen')
                ->references('id_konsumen')
                ->on('konsumen')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
