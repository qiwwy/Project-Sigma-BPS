<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Cetak Laporan Logbook</h3>
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
                    Cetak Logbook
                </h5>
            </div>
            <div class="card-body">
                @php
                    $number = 1;
                @endphp

                <form action="{{ route('cetak.logbook') }}" method="GET" class="mb-5 d-inline">
                    <label for="tanggal_awal">Tanggal Awal :</label>
                    <input type="date" name="tanggal_awal" id="tanggal_awal" value="{{ request('tanggal_awal') }}">

                    <label for="tanggal_akhir">Tanggal Akhir :</label>
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir"
                        value="{{ request('tanggal_akhir') }}">

                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>

                <form action="{{ route('cetak.logbook.export') }}" method="GET" class="mb-5 d-inline">
                    <input type="hidden" name="tanggal_awal" value="{{ request('tanggal_awal') }}">
                    <input type="hidden" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">

                    <button type="submit" class="btn btn-success">Cetak Excel</button>
                </form>

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama Peserta</th>
                            <th>Judul Pekerjaan</th>
                            <th>Presentase Penyelesaian</th>
                            <th>Pemberi Tugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($logbooks as $item)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ $item->date_logbook }}</td>
                                <td>{{ $item->intern->name }}</td>
                                <td>{{ $item->title ?? 'Belum Diisi' }}</td>
                                <td>{{ $item->completion_stat ?? 'Belum Diisi' }}</td>
                                <td>{{ $item->divisi ?? 'Belum Diisi' }}</td>
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
