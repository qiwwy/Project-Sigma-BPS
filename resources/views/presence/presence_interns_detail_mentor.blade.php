<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="mb-0">Detail Presensi: {{ $intern->name }}</h3>
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
                    <div class="col-md-2"><strong>Periode:</strong></div>
                    <div class="col-md-9">{{ $intern->start_date }} - {{ $intern->end_date }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Total Hari:</strong></div>
                    <div class="col-md-9">{{ $totalDays }} hari</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Jumlah Hadir:</strong></div>
                    <div class="col-md-9">{{ $hadirCount }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Presentasi Kehadiran:</strong></div>
                    <div class="col-md-9">{{ number_format($attendancePercentage, 2) }}%</div>
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
                            <th>Nama</th>
                            <th>Waktu Presensi</th>
                            <th>Keterangan</th>
                            <th>Status Presensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($intern->presences as $presence)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ $presence->presence_date }}</td>
                                <td>
                                    {{ $presence->intern->name }}
                                </td>
                                <td>{{ $presence->presence_time }}</td>
                                <td>
                                    @if ($presence->value === 'hadir')
                                        <span class="badge bg-primary">Hadir</span>
                                    @elseif ($presence->value === 'ijin')
                                        <span class="badge bg-success">Izin</span>
                                    @elseif ($presence->value === 'sakit')
                                        <span class="badge bg-warning">Sakit</span>
                                    @else
                                        <span class="badge bg-danger">Alfa</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($presence->status === 1)
                                        <span class="badge bg-success">Presensi Tepat Waktu</span>
                                    @elseif ($presence->status === 0)
                                        <span class="badge bg-danger">Presensi Terlambat</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade text-left" id="editPointModal" tabindex="-1" role="dialog"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editModalLabel">Beri Nilai Pada Aktifitas</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ route('mentor.updatePoint', 'logbook_id_placeholder') }}" method="POST"
                        id="editPointForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label for="point">Nilai</label>
                            <div class="input-group" style="flex: 1;">
                                <select class="form-select" id="edit_point_id" name="point" style="flex: 1;">
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                </select>
                                <label class="input-group-text" for="point_id">Jumlah Point</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ms-1">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
