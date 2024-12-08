<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Perguruan Tinggi / Sekolah </h3>
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
                    data-bs-target="#addSchool">
                    <i class="bi bi-plus-circle-fill"></i> Tambah Sekolah Baru
                </a>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        List Sekolah
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Sekolah</th>
                                <th>Jenis Sekolah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $number = 1;
                            @endphp
                            @foreach ($schools as $item)
                                <tr>
                                    <td>{{ $number++ }}</td>
                                    <td>{{ $item->school_name }}</td>
                                    @if ($item->type_school === 'smk')
                                        <td>Sekolah Menengah Kejuruan</td>
                                    @else
                                        <td>Perguruan Tinggi</td>
                                    @endif
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="badge bg-warning" title="Edit"
                                                data-bs-toggle="modal" data-bs-target="#editSchoolModal"
                                                data-school-id="{{ $item->id }}"
                                                data-school-name="{{ $item->school_name }}"
                                                data-type-school="{{ $item->type_school }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>

                                        </div>
                                        <form action="{{ route('schools.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <div class="btn-group">
                                                <button type="submit" class="badge bg-danger border-0" title="Hapus">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    {{-- Modal Tambah Sekolah --}}
    <div class="modal fade text-left" id="addSchool" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Isi Data Anda</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Content -->
                    <form action="{{ route('schools.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label for="school_name">Nama Sekolah</label>
                            <div class="form-group">
                                <input id="school_name_id" name="school_name" type="text"
                                    placeholder="Masukkan Nama Lengkap Sekolah" class="form-control">
                            </div>
                            <label for="type_school">Jenis Sekolah</label>
                            <div class="input-group" style="flex: 1;">
                                <select class="form-select" id="inputGroupSelect01" name="type_school" style="flex: 1;">
                                    <option value="smk">
                                        Sekolah Menengah Kejuruan</option>
                                    <option value="perguruan_tinggi">
                                        Perguruan Tinggi</option>
                                </select>
                                <label class="input-group-text" for="inputGroupSelect01">Tipe</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
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
    <div class="modal fade text-left" id="editSchoolModal" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel">Edit Data Sekolah</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('schools.update', 'school_id_placeholder') }}" method="POST"
                    id="editSchoolForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <label for="school_name">Nama Sekolah</label>
                        <div class="form-group">
                            <input id="edit_school_name" name="school_name" type="text" class="form-control">
                        </div>
                        <label for="type_school">Jenis Sekolah</label>
                        <div class="input-group">
                            <select class="form-select" id="edit_type_school" name="type_school">
                                <option value="smk">Sekolah Menengah Kejuruan</option>
                                <option value="perguruan_tinggi">Perguruan Tinggi</option>
                            </select>
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
    </div>


</x-main-layout>
