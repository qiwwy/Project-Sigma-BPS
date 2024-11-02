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
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-4 d-flex mb-3">
                        <div class="card flex-fill">
                            <div class="card d-flex flex-column justify-content-center" style="height: 200px;">
                                <div class="card-body px-4 py-4 d-flex flex-column justify-content-center">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <h6 class="text-muted font-semibold">Total Kapasitas</h6>
                                            <span class="font-extrabold mb-0">15 Orang dari 15 Peserta</span>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <form action="{{ route('internRegister.transferAccepted') }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn icon icon-left btn-success w-100">
                                                    <i data-feather="check-circle"></i>
                                                    Send Accepted Participants
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <form action="{{ route('internRegister.transferRejected') }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn icon icon-left btn-danger w-100">
                                                    <i data-feather="check-circle"></i>
                                                    Remove Rejected Participants
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="text-muted font-semibold">Kosong Pada Tanggal</h6>
                                        <span class="font-extrabold mb-0">31-12-2024 (10 Orang)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="text-muted font-semibold">Kosong Pada Tanggal</h6>
                                        <span class="font-extrabold mb-0">31-01-2025 (5 Orang)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="text-muted font-semibold">Kosong Pada Tanggal</h6>
                                        <span class="font-extrabold mb-0">31-01-2025 (5 Orang)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="text-muted font-semibold">Kosong Pada Tanggal</h6>
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

                        @if (session('successTransfered') || session('successRemoved'))
                            <div class="alert alert-light-success color-success">
                                @if (session('successTransfered'))
                                    {{ session('successTransfered') }}
                                @endif
                                @if (session('successRemoved'))
                                    {{ session('successRemoved') }}
                                @endif
                            </div>
                        @endif

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
                                            <span
                                                class="badge
                                                 @if ($item->accept_stat === 'Process') bg-warning
                                                 @elseif($item->accept_stat === 'Accept') bg-success
                                                 @elseif($item->accept_stat === 'Reject') bg-danger @endif">
                                                {{ $item->accept_stat }}
                                            </span>
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
