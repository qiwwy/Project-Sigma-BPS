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
        Schema::create('task_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intern_id')->constrained(
                table: 'interns',
                indexName: 'submission_intern_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('information_id')->constrained(
                table: 'informations',
                indexName: 'submission_information_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->string('file_path');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_submissions');
    }
};
