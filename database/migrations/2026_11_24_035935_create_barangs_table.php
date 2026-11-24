<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();

            $table->string('kode_barang', 50)->unique();
            $table->string('nama_barang', 150);
            $table->string('kategori', 100)->nullable();

            $table->text('deskripsi')->nullable();

            $table->decimal('harga_beli', 15, 2)
                ->default(0);

            $table->decimal('harga_jual', 15, 2)
                ->default(0);

            $table->integer('stok')->default(0);

            $table->string('satuan', 30)
                ->default('pcs');

            $table->string('gambar')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
