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
        Schema::create('intern_queues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('last_date_id')->nullable()->constrained(
                table: 'last_date_interns',
                indexName: 'internQueue_lastDate_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->string('identity_number');
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('school_name');
            $table->string('phone_number')->nullable();
            $table->string('email');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intern_queues');
    }
};
