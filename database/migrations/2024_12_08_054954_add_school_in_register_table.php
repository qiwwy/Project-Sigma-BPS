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
        Schema::table('intern_registers', function (Blueprint $table) {
            $table->foreignId('school_id')->constrained(
                table: 'schools',
                indexName: 'register_school_id'
            )->onUpdate('cascade')->onDelete('cascade')->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('intern_registers', function (Blueprint $table) {
            // Hapus constraint foreign key terlebih dahulu
            $table->dropForeign('register_school_id');
            // Kemudian hapus kolom
            $table->dropColumn('school_id');
        });
    }
};
