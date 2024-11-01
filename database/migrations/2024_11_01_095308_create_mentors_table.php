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
            $table->foreignId('division_id')->constrained(
                table: 'divisions',
                indexName: 'mentors_division_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->string('identity_number');
            $table->string('name');
            $table->text('address');
            $table->string('phone_number');
            $table->string('email');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentors');
    }
};
