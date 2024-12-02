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
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER after_intern_insert_make_logbook
            AFTER INSERT ON interns
            FOR EACH ROW
            BEGIN
                CALL create_logbook_for_intern(NEW.id, NEW.start_date, NEW.end_date);
            END
        ");
    }

    public function down()
    {
        // Menghapus trigger saat rollback
        DB::unprepared('DROP TRIGGER IF EXISTS after_intern_insert');
    }
};
