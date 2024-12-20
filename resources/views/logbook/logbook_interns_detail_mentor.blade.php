<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail LogBook</h3>
                    <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies
                        thanks to simple-datatables.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <!-- Tombol Kembali (lebih kecil) -->
        <div class="col-2">
            <button type="button" class="btn btn-primary w-100" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </button>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Total Point Logbook</strong></div>
                    <div class="col-md-9">{{ $totalPoint }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Nilai Rata-rata Aktifitas</strong></div>
                    <div class="col-md-9">{{ $averagePoint }}</div>
                </div>
            </div>
            <div class="card-header">
                <h5 class="card-title">
                    List Data
                </h5>
            </div>
            <div class="card-body">
                @php
                    $number = 1;
                @endphp
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Judul Pekerjaan</th>
                            <th>Presentase Pekerjaan</th>
                            <th>Pemberi Tugas</th>
                            <th>Penilaian</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($intern->logbooks as $logbook)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ $logbook->date_logbook }}</td>
                                <td>{{ $logbook->title ?? 'Judul pekerjaan masih kosong...' }}</td>
                                <td>{{ $logbook->processing_time ?? 'Waktu pengerjaan masih kosong...' }}</td>
                                <td>
                                    @if ($logbook->divisi === 'P3SDI')
                                        <span class="badge bg-primary">{{ $logbook->divisi }}</span>
                                    @elseif ($logbook->divisi === 'Teknis')
                                        <span class="badge bg-danger">{{ $logbook->divisi }}</span>
                                    @elseif ($logbook->divisi === 'Sub Bagian Umum')
                                        <span class="badge bg-success">{{ $logbook->divisi }}</span>
                                    @else
                                        {{ 'Pemberi tugas masih kosong...' }}
                                    @endif
                                </td>
                                <td>
                                    @if ($logbook->point === null)
                                        <span class="badge bg-danger">{{ 'Belum' }}</span>
                                    @else
                                        <span class="badge bg-success">{{ 'Sudah' }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if (empty($logbook->title) ||
                                            empty($logbook->job_description) ||
                                            empty($logbook->completion_stat) ||
                                            empty($logbook->processing_time) ||
                                            empty($logbook->divisi))
                                        <!-- Badge pengganti jika semua tombol disembunyikan -->
                                        <div class="btn-group">
                                            <span class="badge bg-danger">
                                                No Action
                                            </span>
                                        </div>
                                    @else
                                        <div class="btn-group">
                                            <a href="{{ route('mentor.internLogbook.edit', $logbook->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-main-layout>
