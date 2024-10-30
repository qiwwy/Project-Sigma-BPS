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
        Schema::create('intern_registers', function (Blueprint $table) {
            $table->id();
            $table->string('identity_number');
            $table->string('name');
            $table->text('address');
            $table->string('school_name');
            $table->string('phone_number');
            $table->string('email');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('cover_letter');
            $table->string('image');
            $table->string('token');
            $table->enum('accept_stat', ['Process', 'Accept', 'Reject'])->default('Process');
            $table->enum('register_stat', ['Register', 'Unregister'])->default('Register');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intern_registers');
    }
};
