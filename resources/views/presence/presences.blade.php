<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Presensi Kehadiran {{ session('intern')->name }} 📖</h3>
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

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Presensi Anda
                </h5>
            </div>
            <div class="card-body">
                @php
                    $number = 1;
                @endphp

                <table class="table table-striped" id="table1">
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
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($presences as $item)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ $item->presence_date }}</td>
                                <td>
                                    {{ $item->intern->name }}
                                </td>
                                <td>{{ $item->presence_time }}</td>
                                <td>
                                    @if ($item->value === 'hadir')
                                        <span class="badge bg-primary">Hadir</span>
                                    @elseif ($item->value === 'ijin')
                                        <span class="badge bg-success">Izin</span>
                                    @elseif ($item->value === 'sakit')
                                        <span class="badge bg-warning">Sakit</span>
                                    @else
                                        <span class="badge bg-danger">Alfa</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status === 1)
                                        <span class="badge bg-success">Presensi Tepat Waktu</span>
                                    @elseif ($item->status === 0)
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
        <div class="modal fade" id="detailLogbook" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="date-logbook"></div>
                    </div>
                    <div class="modal-body" id="modal-body">
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
