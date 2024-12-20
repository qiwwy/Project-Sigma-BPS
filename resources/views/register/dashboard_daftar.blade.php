<x-main-layout>
    <nav class="navbar navbar-light mb-2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Tombol Kembali -->
                <a href="/" class="btn btn-primary">
                    <i class="bi bi-arrow-left-circle me-2"></i>
                    Kembali Ke Landing Page
                </a>
                <!-- Tombol Info Lowongan -->
                <a href="/" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#lowonganModal">
                    <i class="bi bi-info-circle me-2"></i>
                    Info Lowongan
                </a>
            </div>
        </div>
    </nav>

    @php
        $lastDates = \App\Models\LastDateInterns::where('count', '!=', 0)->get();
    @endphp

    <div class="container">
        <div class="card shadow-sm rounded">
            <div class="card-header bg-primary text-white text-center">
                <h4>Daftar Magang</h4>
            </div>

            <div class="card-body">
                @if (session('successRegister'))
                    <div class="alert alert-success">
                        {{ session('successRegister') }}
                    </div>
                @endif

                <div class="row g-3">
                    <div class="col-md-3 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="stats-icon bg-purple text-white rounded-circle p-3 mb-3 mx-auto">
                                    <i class="iconly-boldShow"></i>
                                </div>
                                <h6 class="text-muted">Stok Kapasitas</h6>
                                <h5 class="fw-bold">112.000</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="stats-icon bg-blue text-white rounded-circle p-3 mb-3 mx-auto">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                                <h6 class="text-muted">Total Peserta SMK</h6>
                                <h5 class="fw-bold">183.000</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="stats-icon bg-green text-white rounded-circle p-3 mb-3 mx-auto">
                                    <i class="iconly-boldAdd-User"></i>
                                </div>
                                <h6 class="text-muted">Peserta Mahasiswa</h6>
                                <h5 class="fw-bold">80.000</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="stats-icon bg-danger text-white rounded-circle p-3 mb-3 mx-auto">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                                <h6 class="text-muted">Kejuruan Terbanyak</h6>
                                <h5 class="fw-bold">112</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm">
                        Silahkan Daftar Disini
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="inlineForm" tabindex="-1" aria-labelledby="inlineFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="inlineFormLabel">Isi Data Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('internRegister.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="identity_number" class="form-label">NIS / NIM</label>
                                <input type="text" name="identity_number" id="identity_number" class="form-control"
                                    placeholder="Masukkan NIS/NIM Anda">
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Masukkan Nama Anda">
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Masukkan Email Anda">
                            </div>
                            @php
                                $schools = \App\Models\School::all();
                            @endphp
                            <div class="col-md-12">
                                <label for="school_id" class="form-label">Asal Sekolah</label>
                                <select class="form-select" name="school_id" id="school_id" required>
                                    <option value="" selected>Pilih Sekolah</option>
                                    @foreach ($schools as $school)
                                        <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Periode Awal</label>
                                <input type="date" name="start_date" id="start_date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">Periode Akhir</label>
                                <input type="date" name="end_date" id="end_date" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="cover_letter" class="form-label">Surat Pengantar</label>
                                <input type="file" name="cover_letter" id="cover_letter" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="lowonganModal" tabindex="-1" aria-labelledby="inlineFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="inlineFormLabel">Informasi Lowongan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Body Modal -->
                <div class="modal-body">
                    <p class="text-muted mb-4">
                        Berikut adalah daftar tanggal beserta jumlah lowongan yang tersedia di BPS Kota Pekalongan
                    </p>
                    <div class="row g-3">
                        @foreach ($lastDates as $item)
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="card shadow-sm border-light rounded-3">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-2">Kosong Pada Tanggal</h6>
                                        <h5 class="font-extrabold text-primary mb-2">{{ $item->end_date }}</h5>
                                        <p class="mb-1 text-muted">Jumlah: <strong>{{ $item->count }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
