<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intern_id')->constrained(
                table: 'interns',
                indexName: 'presence_intern_id'
            );
            $table->enum('value', ['hadir', 'ijin', 'sakit', 'alfa'])->default('hadir');
            $table->time('presence_time');
            $table->date('presence_date');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
