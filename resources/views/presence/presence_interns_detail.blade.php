<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Kehadiran</h3>
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
            <button type="submit" class="btn icon icon-left btn-primary w-100" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle"></i>
                Kembali
            </button>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    List Data Kehadiran
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
                            <th>Kehadiran</th>
                            <th>Waktu Kehadiran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presenceInterns as $presence)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ $presence->presence_date }}</td>
                                <td>
                                    @if ($presence->value === 'hadir')
                                        <span class="badge bg-success">Hadir</span>
                                    @elseif ($presence->value === 'ijin')
                                        <span class="badge bg-info">Ijin</span>
                                    @elseif($presence->value === 'sakit')
                                        <span class="badge bg-warning">Sakit</span>
                                    @else
                                        <span class="badge bg-danger">Alfa</span>
                                    @endif
                                </td>
                                <td>{{ $presence->presence_time }}</td>
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

        {{-- Modal detail view --}}
        <div class="modal fade" id="detailPresence" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Kehadiran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Tanggal:</strong> <span id="detail-presence-date"></span></p>
                                <p><strong>Waktu:</strong> <span id="detail-presence-time"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Status:</strong> <span id="detail-presence-status"></span></p>
                                <p><strong>Keterangan:</strong> <span id="detail-presence-value"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
