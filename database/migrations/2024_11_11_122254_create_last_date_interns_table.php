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
        Schema::create('last_date_interns', function (Blueprint $table) {
            $table->id();
            $table->date('end_date');
            $table->integer('count'); // Total kapasitas awal
            $table->integer('count_used')->default(0); // Jumlah yang sudah digunakan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('last_date_interns');
    }
};
