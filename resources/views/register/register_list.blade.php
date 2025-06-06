<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Data Registrasi</h3>
                    <p class="text-subtitle text-muted">Lihat daftar lengkap calon peserta magang. Anda dapat melakukan
                        pencarian data registrasi, dan penelusuran data dengan mudah.</p>
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
                    <!-- Total Kapasitas Card -->
                    <div class="col-12 col-md-4 d-flex mb-3">
                        <div class="card flex-fill">
                            <div class="card d-flex flex-column justify-content-center" style="height: 200px;">
                                <div class="card-body px-4 py-4 d-flex flex-column justify-content-center">
                                    @php
                                        $interns = \App\Models\Interns::where('status', 'Active')
                                            ->whereNotNull('division_id')
                                            ->get();
                                        $totalInterns = $interns->count();
                                        $totalMaxIntern = 15;
                                    @endphp
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <h6 class="text-muted font-semibold mt-4">Total Kapasitas</h6>
                                            <span class="font-extrabold mb-0">
                                                {{ $totalInterns }} Peserta Aktif dari {{ $totalMaxIntern }} Maximum Peserta
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 mb-3">
                                            <button type="submit" class="btn icon icon-left btn-success w-100"
                                                data-bs-toggle="modal" data-bs-target="#inlineFormQueue">
                                                <i data-feather="check-circle"></i>
                                                Send Accepted Participants
                                            </button>
                                        </div>
                                        <div class="col-12">
                                            <form action="{{ route('internRegister.transferRejected') }}" method="POST"
                                                id="deleteForm">
                                                @csrf
                                                <button type="button" class="btn icon icon-left btn-danger w-100"
                                                    onclick="confirmDelete()">
                                                    <i data-feather="x-circle"></i>
                                                    Remove Rejected Participants
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Kosong Cards -->
                    <div class="col-12 col-md-8">
                        @php
                            $lastDates = \App\Models\LastDateInterns::where('count', '!=', 0)->get();
                            $totalCapacity = \App\Models\LastDateInterns::sum('count'); // Total kapasitas awal
                            $totalUsed = \App\Models\LastDateInterns::sum('count_used'); // Total yang sudah digunakan
                            $rumus = $totalCapacity + $totalUsed - $totalUsed; // Tanggal Bebas jika kapasitas kurang dari 15
                        @endphp

                        <div class="row">
                            <form action="{{ route('interns.getEndDateUnique') }}" method="POST" id="updateForm">
                                @csrf
                                <div class="col-12 mb-3">
                                    <button type="button"
                                        class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                                        onclick="successUpdate()">
                                        <span>Perbaharui Tanggal Tersedia</span>
                                    </button>
                                </div>
                            </form>

                            @foreach ($lastDates as $item)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                <div class="card shadow-sm border-light rounded-3 {{ \Carbon\Carbon::parse($item->end_date)->lt(now()) ? 'bg-danger bg-opacity-75' : 'bg-success bg-opacity-75' }} text-white">
                                    <div class="card-body">
                                        <h6 class="font-semibold text-white !important">Kosong Pada Tanggal</h6>
                                        <h5 class="font-extrabold mb-0 text-white !important">
                                            {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
                                        </h5>
                                        <p class="mb-0 text-white !important">
                                            Jumlah: <strong>{{ $item->count_used }}/{{ $item->count }}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                            {{-- Tambahkan "Tanggal Bebas" jika kapasitas kurang dari 15 --}}
                            @if ($rumus < 15)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                    <div class="card shadow-sm border-light rounded-3">
                                        <div class="card-body">
                                            <h6 class="text-muted font-semibold">Tanggal Bebas Digunakan</h6>
                                            <h5 class="font-extrabold mb-0">
                                                Tanggal Bebas
                                            </h5>
                                            <p class="mb-0 text-muted">
                                                Jumlah: <strong>{{ 15 - $rumus }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Button Navigation -->
            <div class="row d-flex justify-content-end mb-3">
                <div class="col-auto">
                    <a href="{{ route('interns.index') }}" class="btn icon icon-left btn-primary">
                        <i class="bi bi-people-fill"></i>
                        Daftar Peserta Magang
                    </a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('internQueue.index') }}" class="btn icon icon-left btn-primary">
                        <i class="bi bi-collection-fill"></i>
                        Daftar Antrian Pendaftaran
                    </a>
                </div>
            </div>

            <!-- Data Table -->
            <div class="card">
                @if (session('errorTransfer'))
                    <div class="alert alert-danger">
                        {{ session('errorTransfer') }}
                    </div>
                @endif

                <div class="card-header">
                    <h5 class="card-title">List Data</h5>
                </div>
                <div class="card-body">
                    @if (session('successTransfered') || session('successRemoved'))
                        <div class="alert alert-light-success color-success">
                            {{ session('successTransfered') ?? session('successRemoved') }}
                        </div>
                    @endif

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Asal Sekolah</th>
                                <th>Periode Magang</th>
                                <th>Rekomendasi Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $number = 1; @endphp
                            @foreach ($internRegisters as $item)
                                <tr>
                                    <td>{{ $number++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->school->school_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
                                    </td>
                                    <td>
                                        @if ($item->closest_date)
                                            {{ \Carbon\Carbon::parse($item->closest_date)->format('d M Y') }}
                                        @else
                                            <span class="text-danger">Recomendation Not Found.</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="status-toggle" data-id="{{ $item->id }}">
                                            <span
                                                class="badge @if ($item->accept_stat === 'Process') bg-warning
                                                @elseif($item->accept_stat === 'Accept') bg-success
                                                @elseif($item->accept_stat === 'Reject') bg-danger @endif">
                                                {{ $item->accept_stat }}
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Modal for Queue Selection -->
        <div class="modal fade text-left" id="inlineFormQueue" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Isi Data Anda</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ route('internRegister.transferAccepted') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <h6>Basic Select with Input Group</h6>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Pilih Tanggal</label>
                                <select name="lastDate_id" id="lastDate_id" class="form-select"
                                    id="inputGroupSelect01">
                                    <option selected>Choose...</option>
                                    @foreach ($lastDates as $item)
                                        <option value="{{ $item->id }}">
                                            {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }} -
                                            Dengan Total {{ $item->count }} peserta
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
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

    <script>
        // Validasi input max peserta
        function handleClick() {
            var totalInterns = {{ $totalInterns }};
            var totalMaxIntern = {{ $totalMaxIntern }};

            if (totalInterns >= totalMaxIntern) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Kapasitas peserta sudah penuh!",
                });
                return false;
            }
            return true;
        }

        // Konfirmasi remove rejected interns
        function confirmDelete() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan bisa mengembalikannya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak, batalkan!',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                } else {
                    Swal.fire('Dibatalkan', 'Data Anda aman :)', 'error');
                }
            });
        }

        function successUpdate() {
            Swal.fire({
                icon: "success",
                title: "Update Lowongan Berhasil",
                text: "Lowongan magang telah diperbaharui",

            }).then((result) => {
                if (result.isConfirmed || result.isDismissed) {
                    // Setelah alert ditutup, formulir dikirim
                    document.getElementById('updateForm').submit();
                }
            });
        }
    </script>
</x-main-layout>
