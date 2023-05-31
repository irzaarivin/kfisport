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
        Schema::create('product_ins', function (Blueprint $table) {
            $table->id();
            $table->string("tanggal");
            $table->string("kode_barang");
            $table->string("nama_barang");
            $table->string("jumlah_masuk");
            $table->string("keterangan");
            $table->foreign("kode_barang")->references("kode_barang")->on("products");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_ins');
    }
};
