<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Data Antrian</h3>
                    <p class="text-subtitle text-muted">Lihat daftar lengkap data registrasi yang sudah diterima. Anda
                        dapat melakukan pencarian data registrasi, dan penelusuran data dengan mudah.</p>
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
        <div class="col-3">
            <a href="{{ route('internRegister.index') }}" class="btn icon icon-left btn-primary w-100">
                <i class="bi bi-arrow-left-circle"></i>
                Kembali Ke Daftar Pendaftaran
            </a>
        </div>
    </div>

    <section class="section">
        <!-- Card untuk Menampilkan Total Peserta Magang Aktif -->
        <div class="col-12">
            <div class="row">
                <!-- Total Peserta Magang Aktif -->
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm border-light">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0"><i class="fas fa-user-graduate me-2"></i>Total Peserta Magang
                                Aktif</h5>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="fw-bold text-primary mt-3">{{ $totalActiveInterns }}</h3>
                            <p class="text-muted mb-0">Peserta Magang Aktif</p>
                        </div>
                    </div>
                </div>

                @php
                    $lastDates = \App\Models\LastDateInterns::where('count', '!=', 0)->get();
                @endphp

                <!-- Nonactive Dates Section -->
                <div class="col-md-8">
                    <div class="card shadow-sm border-light">
                        <div class="card-header bg-danger text-white">
                            <h5 class="card-title mb-0"><i class="fas fa-calendar-times me-2"></i> Nonactive Pada Tanggal</h5>
                        </div>
                        <div class="card-body p-3" style="max-height: 250px; overflow-y: auto;">
                            <div class="row">
                                @foreach ($lastDates as $item)
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="card border-light shadow-sm h-100">
                                            <div class="card-body text-center d-flex flex-column justify-content-center" style="max-height: 140px;">
                                                <h6 class="text-danger fw-semibold">Nonactive</h6>
                                                <h5 class="fw-bold">
                                                    {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
                                                </h5>
                                                <p class="text-muted mb-0">
                                                    <i class="fas fa-users me-1"></i> {{ $item->count }} peserta
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">List Data</h5>
            </div>
            <div class="card-body">
                @if (session('successTransferedtoQueue'))
                    <div class="alert alert-light-success color-success">
                        {{ session('successTransferedtoQueue') }}
                    </div>
                @endif

                @php $number = 1; @endphp

                <table class="table table-striped" id="table1">
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
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($internQueueGroup as $lastDateId => $interns)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ \Carbon\Carbon::parse($interns->first()->start_date)->format('d M Y') }}</td>
                                <td>
                                    @php
                                        $endDate = $interns->first()->lastDate->end_date ?? null;
                                    @endphp

                                    @if ($endDate)
                                        {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($interns->first()->start_date)->format('d M Y') }}
                                    @endif
                                </td>
                                <td>{{ $interns->first()->school_name }}</td>
                                <td>{{ $interns->count() }}</td>
                                <td>
                                    <a href="{{ route('internQueue.showDetailQueue', ['last_date_id' => $lastDateId]) }}"
                                        class="btn btn-primary">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <form action="{{ route('internQueue.transferToIntern') }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="last_date_id" value="{{ $lastDateId }}">
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-send"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-main-layout>
