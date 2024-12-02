<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('logbook_intern', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intern_id')->constrained(
                table: 'interns',
                indexName: 'logbook_intern_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->date('date_logbook');
            $table->string('title')->nullable();
            $table->string('job_description')->nullable();
            $table->enum('completion_stat', [25, 50, 75, 100])->nullable();
            $table->enum('processing_time', ['1 Jam', '1 - 3 Jam', '3 - 5 Jam', '5 - 8 Jam'])->nullable();
            $table->enum('divisi', ['P3SDI', 'Teknis', 'Sub Bagian Umum'])->nullable();
            $table->enum('accept_stat', ['Pending', 'Accept', 'Reject'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbook_intern');
    }
};
