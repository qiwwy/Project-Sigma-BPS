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
            CREATE PROCEDURE create_logbook_for_intern(IN intern_id INT, IN start_date DATE, IN end_date DATE)
            BEGIN
                DECLARE current_day DATE;  -- Ganti current_date dengan current_day

                -- Inisialisasi tanggal pertama
                SET current_day = start_date;

                -- Loop sampai tanggal terakhir
                WHILE current_day <= end_date DO
                    -- Menambahkan record logbook untuk setiap tanggal dalam rentang
                    INSERT INTO logbook_intern (
                        intern_id,
                        date_logbook,
                        title,
                        job_description,
                        completion_stat,
                        processing_time,
                        divisi,
                        accept_stat,
                        created_at,
                        updated_at
                    )
                    VALUES (
                        intern_id,
                        current_day,  -- Gunakan current_day yang sudah dideklarasikan
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        'Pending',
                        NOW(),
                        NOW()
                    );

                    -- Increment tanggal ke hari berikutnya
                    SET current_day = DATE_ADD(current_day, INTERVAL 1 DAY);  -- Gunakan current_day
                END WHILE;
            END
        ");
    }

    public function down()
    {
        // Untuk menghapus stored procedure saat rollback
        DB::unprepared('DROP PROCEDURE IF EXISTS create_logbook_for_intern');
    }
};
