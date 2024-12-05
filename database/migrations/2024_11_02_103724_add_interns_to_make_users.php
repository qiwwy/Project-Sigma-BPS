<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            "CREATE TRIGGER add_interns_to_make_user
            AFTER INSERT ON `interns`
            FOR EACH ROW
            BEGIN
                INSERT INTO `users` (interns_id, username, password, created_at, updated_at)
                VALUES (NEW.id, NEW.identity_number, NEW.identity_number, NOW(), NOW());
            END;"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('make_users', function (Blueprint $table) {
            //
        });
    }
};
