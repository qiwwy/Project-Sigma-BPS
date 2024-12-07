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
        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['mentor', 'admin']);
            $table->string('identity_number');
            $table->string('name');
            $table->text('address');
            $table->string('phone_number');
            $table->enum('division', ['P3SDI', 'Teknis', 'Sub Bagian Umum']);
            $table->string('email');
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentors');
    }
};
