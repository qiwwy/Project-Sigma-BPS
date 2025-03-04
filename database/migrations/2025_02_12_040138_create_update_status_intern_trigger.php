<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Trigger untuk INSERT
        DB::statement('
            CREATE TRIGGER update_intern_status_on_insert
            BEFORE INSERT ON interns
            FOR EACH ROW
            BEGIN
                IF NEW.end_date < CURDATE() THEN
                    SET NEW.status = "Nonactive";
                END IF;
            END
        ');

        // Trigger untuk UPDATE
        DB::statement('
            CREATE TRIGGER update_intern_status_on_update
            BEFORE UPDATE ON interns
            FOR EACH ROW
            BEGIN
                IF NEW.end_date < CURDATE() THEN
                    SET NEW.status = "Nonactive";
                END IF;
            END
        ');
    }

    public function down(): void
    {
        // Hapus trigger saat rollback
        DB::statement('DROP TRIGGER IF EXISTS update_intern_status_on_insert');
        DB::statement('DROP TRIGGER IF EXISTS update_intern_status_on_update');
    }
};
