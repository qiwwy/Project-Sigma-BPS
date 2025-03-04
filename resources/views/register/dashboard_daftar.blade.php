<x-main-layout>
    <nav class="navbar navbar-light mb-2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Tombol Kembali -->
                <a href="/" class="btn btn-primary">
                    <i class="bi bi-arrow-left-circle me-2"></i>
                </a>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm">
                    <i class="bi bi-pen"></i>
                    Daftar Disini
                </button>

                <a href="/" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#lowonganModal">
                    <i class="bi bi-info-circle me-2"></i>
                    Info Lowongan Magang
                </a>

                <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#daftarAntrian">
                    <i class="bi bi-card-checklist"></i>
                    List Antrian
                </a>
            </div>
        </div>
    </nav>

    @php
        $lastDates = \App\Models\LastDateInterns::where('count', '!=', 0)->get();
        $internQueueGroup = \App\Models\InternQueue::with('lastDate')->get();

        $number = 1;
    @endphp

    @if (session('successRegister'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: "success",
                    title: "Pendaftaran Berhasil",
                    text: "{{ session('successRegister') }}",
                });
            });
        </script>
    @endif

    <div class="container">
        @if ($errors->any())
            <div class="pt-3">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="card shadow-sm rounded">
            <div class="card-header bg-primary text-white text-center">
                <h4>Daftar Magang</h4>
            </div>

            <div class="card-body">
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
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5>Apa syarat untuk mendaftar magang di BPS?</h5>
                            <p>Untuk melaksanakan kegiatan magang di BPS, calon peserta harus merupakan pelajar atau
                                mahasiswa aktif yang masih menjalani masa studi. Selain itu, kegiatan magang ini harus
                                mendapatkan persetujuan dari pihak sekolah atau universitas serta izin dari wali calon
                                peserta.</p>
                            <p>Selain persyaratan tersebut, BPS juga memiliki syarat khusus untuk menerima siswa atau
                                mahasiswa yang ingin mengikuti program magang. Anda dapat melihat <a href="/"
                                    data-bs-toggle="modal" data-bs-target="#daftarSyarat">syarat lengkapnya di sini</a>.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5>Apa yang dilakukan saat Magang di BPS??</h5>
                            <p>Setelah resmi diterima sebagai peserta magang di BPS Kota Pekalongan, peserta perlu
                                melaksanakan beberapa hal penting agar kegiatan magang berjalan lancar, sesuai aturan,
                                dan bermanfaat bagi kedua belah pihak.</p>
                            <p>Untuk informasi lebih lengkap terkait apa saja yang perlu dilakukan oleh peserta selama
                                melakukan kegiatan magang dapat <a href="" data-bs-toggle="modal"
                                    data-bs-target="#daftarKegiatan">dilihat disini</a></p>
                        </div>
                    </div>
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

    @php
        $lastDates = \App\Models\LastDateInterns::where('count', '!=', 0)->get();
        $totalCapacity = \App\Models\LastDateInterns::sum('count'); // Total kapasitas awal
        $totalUsed = \App\Models\LastDateInterns::sum('count_used'); // Total yang sudah digunakan
        $rumus = $totalCapacity + $totalUsed - $totalUsed; // Tanggal Bebas jika kapasitas kurang dari 15
    @endphp

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
                        {{-- Daftar Tanggal Tersedia --}}
                        @foreach ($lastDates as $item)
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="card shadow-sm border-light rounded-3">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-2">Kosong Pada Tanggal</h6>
                                        <h5 class="font-extrabold text-primary mb-2">
                                            {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
                                        </h5>
                                        <p class="mb-1 text-muted">
                                            Jumlah: <strong>{{ $item->count_used }} / {{ $item->count }}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Tambahkan "Tanggal Bebas" --}}
                        @php
                            $totalCapacity = \App\Models\LastDateInterns::sum('count'); // Total kapasitas
                            $totalUsed = \App\Models\LastDateInterns::sum('count_used'); // Total yang sudah digunakan
                            $rumus = max(0, $totalCapacity - $totalUsed); // Sisa kapasitas (tidak negatif)
                        @endphp

                        @if ($rumus < 15)
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="card shadow-sm border-light rounded-3">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-2">Tanggal Bebas Digunakan</h6>
                                        <h5 class="font-extrabold text-primary mb-2">Tanggal Bebas</h5>
                                        <p class="mb-1 text-muted">Jumlah: <strong>{{ 15 - $rumus }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="daftarAntrian" tabindex="-1" aria-labelledby="inlineFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="inlineFormLabel">Daftar Antrian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Body Modal -->
                <div class="modal-body">
                    <p class="text-muted mb-4">
                        Berikut adalah daftar antrian peserta yang diterima di BPS Kota Pekalongan beserta informasi
                        tanggal keberangkatan.
                    </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Peserta</th>
                                    <th>Tanggal Dimulai</th>
                                    <th>Asal Sekolah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($internQueueGroup as $key => $intern)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $intern->name }}</td>
                                        <td>
                                            @php
                                                $endDate = $intern->lastDate->end_date ?? null; // Akses langsung ke relasi lastDate
                                            @endphp

                                            @if ($endDate)
                                                {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($intern->start_date)->format('d M Y') }}
                                            @endif
                                        </td>
                                        <td>{{ $intern->school_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="daftarSyarat" tabindex="-1" aria-labelledby="inlineFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="inlineFormLabel">Daftar Syarat Magang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Body Modal -->
                <div class="modal-body">
                    <p class="text-muted mb-4">
                        Berikut adalah beberapa syarat untuk dapat melaksanakna kegiatan magang di BPS
                    </p>
                    <div class="row g-3">
                        <ul class="list-group">
                            <li class="list-group-item">1. Wajib merupakan pelajar atau mahasiswa aktif pada saat ini
                            </li>
                            <li class="list-group-item">2. Tidak ada batasan untuk jenis kejuruan atau program studi
                                yang diambil</li>
                            <li class="list-group-item">3. Melampirkan surat pengantar dari kampus sebagai bukti dari
                                persetujuan seluruh pihak</li>
                            <li class="list-group-item">4. Bersedia mematuhi segala aturan terkait kegiatan magang yang
                                sudah ditetapkan oleh pihak BPS</li>
                            <li class="list-group-item">5. Selama kegiatan magang berlangsung, peserta wajib dapat
                                melaksanakan kegiatan magang baik secara individu maupun dalam kelompok.</li>
                        </ul>
                    </div>
                </div>
                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="daftarKegiatan" tabindex="-1" aria-labelledby="inlineFormLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="inlineFormLabel">Daftar Kegiatan Magang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Body Modal -->
                <div class="modal-body">
                    <p class="text-muted mb-4">
                        Berikut adalah beberapa kegiatan yang akan dilakukan selama kegiatan magang di BPS berlangsung
                    </p>
                    <div class="row g-3">
                        <ul class="list-group">
                            <li class="list-group-item">1. Setelah berhasil menjadi peserta magang, peserta akan
                                diberikan akun untuk mengakses sistem informasi magang di website.
                            </li>
                            <li class="list-group-item">2. Sistem ini akan digunakan oleh peserta magang selama
                                kegiatan magang, seperti untuk absen.</li>
                            <li class="list-group-item">3. Selain absensi, sistem ini juga menyediakan fitur yang
                                berkaitan dengan informasi yang diberikan oleh pembimbing magang BPS kepada peserta.
                            </li>
                            <li class="list-group-item">4. Sistem juga menyediakan fitur pengisian logbook yang
                                nantinya akan digunakan oleh peserta untuk mencatat kegiatan harian.</li>
                            <li class="list-group-item">5. Di akhir kegiatan magang, peserta akan memperoleh sertifikat
                                dari BPS sebagai bukti bahwa mereka telah melaksanakan magang di sana.</li>
                        </ul>
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
