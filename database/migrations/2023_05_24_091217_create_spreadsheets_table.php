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
        Schema::create('spreadsheets', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("description");
            $table->string("owner");
            $table->text("data");
            $table->string("access")->nullable();
            $table->string("slug")->unique();
            $table->foreign("owner")->references("email")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spreadsheets');
    }
};
