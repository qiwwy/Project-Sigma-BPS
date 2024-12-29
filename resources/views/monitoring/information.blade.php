<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Tugas & Information</h3>
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

        @if (session('intern')->role === 'intern')
            <div class="row mb-3 mt-5" style="display: none;">
                <div class="col-2">
                    <a href="#" class="btn icon icon-left btn-success w-100" data-bs-toggle="modal"
                        data-bs-target="#addInformation">
                        <i class="bi bi-plus-circle-fill"></i> Informasi Baru
                    </a>
                </div>
            </div>
        @else
            <div class="row mb-3 mt-5">
                <div class="col-2">
                    <a href="#" class="btn icon icon-left btn-success w-100" data-bs-toggle="modal"
                        data-bs-target="#addInformation">
                        <i class="bi bi-plus-circle-fill"></i> Informasi Baru
                    </a>
                </div>
            </div>
        @endif

        <section class="section">
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
                                @if (session('intern')->role === 'intern')
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Tipe Information</th>
                                    <th>Target Information</th>
                                @else
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Tipe Information</th>
                                    <th>Target Information</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $number = 1;
                            @endphp

                            @foreach ($informations as $item)
                                <tr>
                                    @if (session('intern')->role === 'intern')
                                        <td>{{ $number++ }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            @if ($item->type === 'event')
                                                <span class="badge bg-success">Acara</span>
                                            @elseif ($item->type === 'task')
                                                <span class="badge bg-primary">Tugas</span>
                                            @elseif ($item->type === 'info')
                                                <span class="badge bg-warning">Information</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->division_id === null)
                                                <span class="badge bg-success">Semua Peserta</span>
                                            @elseif ($item->division_id === 1)
                                                <span class="badge bg-primary">P3SDI</span>
                                            @elseif ($item->division_id === 2)
                                                <span class="badge bg-danger">Teknis</span>
                                            @elseif ($item->division_id === 3)
                                                <span class="badge bg-warning">Sub Bagian Umum</span>
                                            @endif
                                        </td>
                                    @else
                                        <td>{{ $number++ }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            @if ($item->type === 'event')
                                                <span class="badge bg-success">Acara</span>
                                            @elseif ($item->type === 'task')
                                                <span class="badge bg-primary">Tugas</span>
                                            @elseif ($item->type === 'info')
                                                <span class="badge bg-warning">Information</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->division_id === null)
                                                <span class="badge bg-success">Semua Peserta</span>
                                            @elseif ($item->division_id === 1)
                                                <span class="badge bg-primary">P3SDI</span>
                                            @elseif ($item->division_id === 2)
                                                <span class="badge bg-danger">Teknis</span>
                                            @elseif ($item->division_id === 3)
                                                <span class="badge bg-warning">Sub Bagian Umum</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('monitoring.information.edit', $item->id) }}"
                                                    class="badge bg-warning">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                            </div>
                                            <form action="{{ route('monitoring.information.destroy', $item->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <div class="btn-group">
                                                    <button type="submit" class="badge bg-danger border-0"
                                                        title="Hapus">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade text-left" id="addInformation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Informasi</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Content -->
                    <form action="{{ route('monitoring.information.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <!-- Title -->
                            <label for="title">Judul</label>
                            <div class="form-group">
                                <input id="title" name="title" type="text"
                                    placeholder="Masukkan Judul Informasi" class="form-control" required>
                            </div>

                            <!-- Description -->
                            <label for="description">Deskripsi</label>
                            <div class="form-group">
                                <textarea id="description" name="description" placeholder="Masukkan Deskripsi" class="form-control" rows="3"
                                    required></textarea>
                            </div>

                            @if (session('intern')->role === 'mentor')
                                <label for="type">Jenis Informasi</label>
                                <div class="form-group">
                                    <select id="type" name="type" class="form-control" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="event">Acara</option>
                                        <option value="task">Tugas</option>
                                        <option value="info">Informasi</option>
                                    </select>
                                </div>
                                <input type="hidden" name="target" value="division">
                                <input type="hidden" name="division_id"
                                    value="{{ session('intern')->division_id }}">
                            @else
                                <!-- Type -->
                                <div class="row">
                                    <div class="col">
                                        <label for="type">Jenis Informasi</label>
                                        <div class="form-group">
                                            <select id="type" name="type" class="form-control" required>
                                                <option value="">-- Pilih Jenis --</option>
                                                <option value="event">Acara</option>
                                                <option value="task">Tugas</option>
                                                <option value="info">Informasi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- Target -->
                                        <label for="target">Target Informasi</label>
                                        <div class="form-group">
                                            <select id="target" name="target" class="form-control"
                                                onchange="toggleDivisionInput()" required>
                                                <option value="">-- Pilih Target --</option>
                                                <option value="all">Semua Peserta</option>
                                                <option value="division">Divisi Tertentu</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <!-- Division ID (Shown if Target is Division) -->
                                <div id="division_input" style="display: none;">
                                    <label for="division_id">Divisi</label>
                                    <div class="form-group">
                                        <select id="division_id" name="division_id" class="form-control">
                                            <option value="">-- Pilih Divisi --</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->division_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <!-- Document -->
                            <label for="document">Dokumen</label>
                            <div class="form-group">
                                <input id="document" name="document" type="file" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col">
                                    <!-- Start Date -->
                                    <label for="start_date">Tanggal Mulai</label>
                                    <div class="form-group">
                                        <input id="start_date" name="start_date" type="date" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- End Date -->
                                    <label for="end_date">Tanggal Selesai</label>
                                    <div class="form-group">
                                        <input id="end_date" name="end_date" type="date" class="form-control"
                                            required>
                                    </div>
                                </div>
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
        function toggleDivisionInput() {
            const target = document.getElementById('target').value;
            const divisionInput = document.getElementById('division_input');

            if (target === 'division') {
                divisionInput.style.display = 'block';
            } else {
                divisionInput.style.display = 'none';
            }
        }
    </script>
</x-main-layout>
