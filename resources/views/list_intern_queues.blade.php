<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Antrian Penerimaan</h3>
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
                    List Data
                </h5>
            </div>
            <div class="card-body">
                @php
                    $number = 1;
                @endphp
                <table class="table table-striped" id="table1">
                    @php
                        $number = 1;
                    @endphp
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Dimulai</th>
                            <th>Tanggal Dikirim</th>
                            <th>Asal Sekolah</th>
                            <th>Jumlah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($internQueueGroup as $lastDateId => $interns)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ \Carbon\Carbon::parse($interns->first()->start_date)->format('d M Y') }}</td>
                                <td>
                                    @php
                                        $endDate = \Carbon\Carbon::parse(
                                            $interns->first()->lastDate->end_date,
                                        )->startOfDay(); // Menghitung mulai dari tengah malam
                                        $now = \Carbon\Carbon::now()->startOfDay(); // Waktu sekarang juga mulai dari tengah malam
                                        $daysLeft = $now->diffInDays($endDate, false); // Menghitung perbedaan hari dengan 'now' sebagai tanggal awal
                                    @endphp
                                    @if ($daysLeft > 0)
                                        {{ $daysLeft }} Hari Lagi
                                    @elseif ($daysLeft === 0)
                                        <span class="badge bg-success">Dapat Dikirim</span>
                                    @elseif($daysLeft < 0)
                                        <span class="badge bg-warning"> {{ abs($daysLeft) }} Hari Terlewatkan</span>
                                    @else
                                        Hari Ini
                                    @endif

                                </td>
                                <td>{{ $interns->first()->school_name }}</td>
                                <td>{{ $interns->count() }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>
                                    <a href="#" class="btn btn-success"><i class="bi bi-send"></i></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-main-layout>
