<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Prakerin</title>
    <style>
        /* Styling remains unchanged */
    </style>
</head>

<body>
    <div class="container">
        <div id="sertifikat_depan" class="page-break">
            <h1>
                BPS KOTA PEKALONGAN
            </h1>
            <p class="address">
                Alamat : Jl. Singosari, Podosugih, Kec. Pekalongan Bar., Kota Pekalongan, Jawa Tengah 51111
            </p>
            <hr>
            <h2>
                SERTIFIKAT PRAKERIN
            </h2>
            <p class="description">
                Instruktur DU/DI BPS Kota Pekalongan menerangkan bahwa :
            </p>
            <h3>
                {{$intern->name}}
            </h3>
            <p class="description_2">
                Telah melaksanakan Kegiatan Magang di BPS Kota Pekalongan <br>
                Mulai dari tanggal
                {{$intern->start_date}} - {{$intern->end_date}}
            </p>

            <!-- Menambahkan Average Points dan Attendance Score -->
            <p class="description_2">
                Rata-rata Poin Logbook: {{$intern->average_points}} <br>
                Nilai Kehadiran: {{$intern->attendance_score}}
            </p>

            <p class="signature">
                Pekalongan,
                <?= date('d F Y') ?>, <br>
                Instruktur DU/DI BPS Kota Pekalongan <br> <br> <br>

                <b><u>Kepala BPS Kota Pekalongan</u></b> <br>
                <b>081932043232</b>
            </p>
        </div>
    </div>
</body>

</html>
