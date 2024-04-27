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
        Schema::create('stoks', function (Blueprint $table) {
            $table->id();
            // produk id
            $table->foreignId('produk_id')
                ->constrained('produks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('kode_stok_produk')->unique();
            $table->enum('status', ['gudang', 'sales', 'sold']);
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_distribusi')->nullable();
            $table->datetime('tanggal_transaksi')->nullable();
            // harga jual,modal
            $table->integer('harga_jual')->nullable();
            $table->integer('modal')->nullable();

            $table->bigInteger('outlet_id')->nullable();
            $table->bigInteger('sale_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoks');
    }
};
