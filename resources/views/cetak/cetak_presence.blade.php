<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Cetak Laporan Presensi</h3>
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
                    Cetak Presensi
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('cetak.presence') }}" method="GET" class="mb-4 d-inline">
                    <label for="tanggal_awal">Tanggal Awal :</label>
                    <input type="date" name="tanggal_awal" id="tanggal_awal" value="{{ request('tanggal_awal') }}">

                    <label for="tanggal_akhir">Tanggal Akhir :</label>
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir"
                        value="{{ request('tanggal_akhir') }}">

                    <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                    <button type="button" onclick="clearDates()" class="btn btn-danger">Clear Filter</button>
                </form>

                <form action="{{ route('cetak.presence.export') }}" method="GET" class="mb-5 d-inline">
                    <input type="hidden" name="tanggal_awal" value="{{ request('tanggal_awal') }}">
                    <input type="hidden" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">

                    <button type="submit" class="btn btn-success">Cetak Excel</button>
                </form>
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
                            <th>Nama Peserta</th>
                            <th>Keterangan</th>
                            <th>Waktu Presensi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($presences->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">
                                    @if (!request('tanggal_awal') || !request('tanggal_akhir'))
                                        <div class="alert alert-light-danger color-danger">Tidak ada data untuk
                                            ditampilkan. Harap pilih
                                            tanggal awal dan akhir.</div>
                                    @else
                                        <div class="alert alert-light-danger color-danger"> Data presensi tidak
                                            ditemukan untuk rentang tanggal yang dipilih.</div>
                                    @endif
                                </td>
                            </tr>
                        @else
                            @foreach ($presences as $item)
                                <tr>
                                    <td>{{ $number++ }}</td>
                                    <td>{{ $item->presence_date }}</td>
                                    <td>{{ $item->intern->name }}</td>
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
                                    <td>{{ $item->presence_time }}</td>
                                    <td>
                                        @if ($item->status === 1)
                                            <span class="badge bg-success">Presensi Tepat Waktu</span>
                                        @else
                                            <span class="badge bg-danger">Presensi Terlambat</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        function clearDates() {
            // Menghapus tanggal_awal dan tanggal_akhir dari URL
            const url = new URL(window.location);
            url.searchParams.delete('tanggal_awal');
            url.searchParams.delete('tanggal_akhir');
            window.location.href = url.toString(); // Arahkan ulang ke URL yang sudah dibersihkan
        }
    </script>

</x-main-layout>
