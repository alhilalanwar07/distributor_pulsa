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
        Schema::create('outlets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_outlet')->unique();
            $table->text('foto_outlet');
            $table->string('nama_outlet');
            $table->string('nama_pemilik');
            $table->string('telepon_pemilik');
            $table->text('alamat_outlet');

            // cabang
            $table->foreignId('cabang_id')
                ->constrained('cabangs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outlets');
    }
};
