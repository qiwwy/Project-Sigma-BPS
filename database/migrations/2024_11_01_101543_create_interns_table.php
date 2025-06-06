<?php

use Illuminate\Database\Eloquent\Relations\Relation;
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
        Schema::create('interns', function (Blueprint $table) {
            $table->id();
            $table->string('identity_number');
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('school_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['Active', 'Nonactive'])->default('Active');
            $table->string('image')->nullable();
            $table->enum('role', ['intern', 'admin', 'mentor']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interns');
    }
};
