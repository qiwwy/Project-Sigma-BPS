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
            $table->text('address');
            $table->string('school_name')->nullable();
            $table->string('phone_number');
            $table->string('email');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['Active', 'Nonactive'])->default('Active');
            $table->string('image');
            $table->enum('role', ['intern', 'mentor', 'admin']);
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
