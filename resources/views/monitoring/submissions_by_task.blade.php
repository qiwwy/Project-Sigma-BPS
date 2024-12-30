<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>List Tugas Terkumpul</h3>
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
        <!-- Tombol Kembali (lebih kecil) -->
        <div class="col-2">
            <button type="button" class="btn btn-primary w-100" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </button>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    List Pengumpulan
                </h5>
            </div>
            <div class="card-body">
                @php
                    $number = 1;
                @endphp
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Peserta</th>
                            <th>Nama File</th>
                            <th>Sekolah</th>
                            <th>Catatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($informations->submissions as $submission)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ $submission->intern->name }}</td>
                                <td>{{ $submission->intern->school_name }}</td>
                                <td>{{ $submission->file_path }}</td>
                                <td>{{ $submission->note }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('monitoring.taskSubmission.download', ['taskSubmission' => $submission->id]) }}"
                                            class="badge bg-success">
                                            Download
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
</x-main-layout>
