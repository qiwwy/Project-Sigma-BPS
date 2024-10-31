<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Pendaftar Magang</h3>
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
        <section class="section">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="text-muted font-semibold">Total Kapasitas</h6>
                                        <span class="font-extrabold mb-0">15 Orang dari 15 Peserta</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="text-muted font-semibold">Kosong Pada Tanggal (Part 1)</h6>
                                        <span class="font-extrabold mb-0">31-12-2024 (10 Orang)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="text-muted font-semibold">Kosong Pada Tanggal (Part 2)</h6>
                                        <span class="font-extrabold mb-0">31-01-2025 (5 Orang)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        List Data
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Asal Sekolah</th>
                                <th>Periode Magang</th>
                                <th>Total Waktu</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $number = 1;
                            @endphp
                            @foreach ($internRegisters as $item)
                                <tr>
                                    <td>{{ $number++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ Str::limit($item->school_name, 40, '...') }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }} -
                                        {{ \Carbon\Carbon::parse($item->end_date)->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        @php
                                            $startDate = \Carbon\Carbon::parse($item->start_date);
                                            $endDate = \Carbon\Carbon::parse($item->end_date);
                                            $daysDifference = $startDate->diffInDays($endDate);
                                        @endphp
                                        {{ $daysDifference }} Hari</td>
                                    <td>
                                        <a href="#" class="status-toggle" data-id="{{ $item->id }}">
                                            <span class="badge bg-warning">{{ $item->accept_stat }}</span>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="">
                                                <span class="badge bg-primary">
                                                    <i class="bi bi-eye-fill"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="">
                                                <span class="badge bg-warning">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="">
                                                <span class="badge bg-danger">
                                                    <i class="bi bi-trash-fill"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-main-layout>
