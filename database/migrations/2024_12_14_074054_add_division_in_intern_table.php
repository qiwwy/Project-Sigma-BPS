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
        Schema::table('interns', function (Blueprint $table) {
            $table->foreignId('division_id')->nullable()->constrained(
                table: 'divisions',
                indexName: 'intern_division_id'
            )->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interns', function (Blueprint $table) {
            // Hapus constraint foreign key terlebih dahulu
            $table->dropForeign('intern_division_id');
            // Kemudian hapus kolom
            $table->dropColumn('division_id');
        });
    }
};
