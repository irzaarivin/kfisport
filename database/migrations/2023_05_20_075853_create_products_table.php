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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("kode_barang")->unique();
            $table->string("nama_barang");
            $table->string("stok_awal");
            $table->string("masuk");
            $table->string("keluar");
            $table->string("stok_akhir");   
            $table->enum("satuan", ["KARUNG", "KEPING", "KG", "LEMBAR", "M2", "PCS", "SULUR", ""]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
