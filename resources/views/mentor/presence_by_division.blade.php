<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Presensi Kehadiran Magang Divisi {{ session('intern')->name }}</h3>
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
        <div class="col-3">
            <a href="#" class="btn icon icon-left btn-success w-100" data-bs-toggle="modal"
                data-bs-target="#absenModal" class="btn btn-primary btn-block">
                <i class="bi bi-file-plus"></i>
                Absenkan Peserta
            </a>
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
                            <th>Nama Peserta</th>
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
                                <td>{{ $item->intern->name }}</td>
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

        <div class="modal fade text-left" id="absenModal" tabindex="-1" role="dialog"
            aria-labelledby="absenModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="absenModalLabel">Lakukan Presensi Disini</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk Presensi -->
                        <form action="{{ route('mentor.storePresencebyMentor') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            @php
                                $internSession = session('intern');
                                $divisionId = $internSession->division_id;
                                $interns = \App\Models\Interns::where('division_id', $divisionId)
                                    ->where('role', 'intern')
                                    ->get();
                            @endphp

                            <!-- Pilih Intern -->
                            <div class="mb-3">
                                <label for="intern_id" class="form-label">Pilih Intern</label>
                                <select name="intern_id" id="intern_id" class="form-select" required>
                                    @foreach ($interns as $intern)
                                        <option value="{{ $intern->id }}">{{ $intern->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status Kehadiran -->
                            <div class="mb-3">
                                <label for="value" class="form-label">Status Kehadiran</label>
                                <select name="value" id="value" class="form-select" required>
                                    <option value="hadir">Hadir</option>
                                    <option value="ijin">Izin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="alfa">Alfa</option>
                                </select>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tutup</span>
                                </button>
                                <button type="submit" class="btn btn-primary ms-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Kirim</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
