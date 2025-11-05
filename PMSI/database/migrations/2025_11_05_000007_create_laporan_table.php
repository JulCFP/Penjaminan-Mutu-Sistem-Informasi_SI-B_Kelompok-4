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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->unsignedBigInteger('id_penjual');
            $table->string('periode', 50)->nullable();
            $table->decimal('total_penjualan', 12, 2)->nullable();
            $table->integer('jumlah_transaksi')->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_penjual')
                ->references('id_penjual')
                ->on('penjual')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
