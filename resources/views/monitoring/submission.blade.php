<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Tugas Yang Dikumpulkan </h3>
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

        <div class="row mb-3 mt-5">
            <div class="col-2">
                <a href="#" class="btn icon icon-left btn-success w-100" data-bs-toggle="modal"
                    data-bs-target="#addSubmission">
                    <i class="bi bi-plus-circle-fill"></i> Kumpulkan Tugas
                </a>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        List Tugas
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul Tugas</th>
                                <th>Nama File</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $number = 1;
                            @endphp
                            @foreach ($taskSubmission as $item)
                                <tr>
                                    <td>{{ $number++ }}</td>
                                    <td>{{ $item->information->title }}</td>
                                    <td>{{ basename($item->file_path) }}</td>
                                    <td>{{ $item->note }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    {{-- Modal Tambah divisi --}}
    <div class="modal fade text-left" id="addSubmission" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Kumpulkan Tugas Anda</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Content -->
                    <form action="{{ route('monitoring.submission.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <!-- Information ID (Dropdown) -->
                            <la for="information_id">Pilih Tugas</la
                                bel>
                            <div class="form-group">
                                <select id="information_id" name="information_id" class="form-control" required>
                                    <option value="">-- Pilih Tugas --</option>
                                    @foreach ($informations as $information)
                                        <option value="{{ $information->id }}">
                                            {{ $information->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- File Upload -->
                            <label for="file_path">Unggah File</label>
                            <div class="form-group">
                                <input id="file_path" name="file_path" type="file" class="form-control" required>
                            </div>

                            <!-- Note -->
                            <label for="note">Catatan (Opsional)</label>
                            <div class="form-group">
                                <textarea id="note" name="note" class="form-control" rows="3" placeholder="Masukkan catatan (jika ada)"></textarea>
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

    {{-- Modal Update Sekolah --}}
    {{-- <div class="modal fade text-left" id="editDivisionModal" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel">Edit Data Divisi</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('divisions.update', 'division_id_placeholder') }}" method="POST"
                    id="editDivisionForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <label for="division_name">Nama Divisi</label>
                        <div class="form-group">
                            <input id="edit_division_name" name="division_name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1">
                            <span class="d-none d-sm-block">Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
</x-main-layout>
