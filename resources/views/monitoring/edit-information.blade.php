<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Tugas Anda Disini</h3>
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
        <div class="col-2">
            <button type="submit" class="btn icon icon-left btn-primary w-100" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle"></i>
                Kembali
            </button>
        </div>
    </div>

    <section class="section">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Informasi</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{ route('monitoring.information.update', $information->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <!-- Judul Informasi -->
                                <div class="col-md-6 col-12 mb-3">
                                    <div class="form-group d-flex">
                                        <label for="title" class="mr-2" style="width: 30%;">Judul Informasi</label>
                                        <input type="text" id="title" class="form-control" name="title" value="{{ old('title', $information->title) }}" required>
                                    </div>
                                </div>

                                <!-- Jenis Informasi -->
                                <div class="col-md-6 col-12 mb-3">
                                    <div class="form-group d-flex">
                                        <label for="type" class="mr-2" style="width: 30%;">Jenis Informasi</label>
                                        <select class="form-select" id="type" name="type" required>
                                            <option value="event" {{ old('type', $information->type) == 'event' ? 'selected' : '' }}>Acara</option>
                                            <option value="task" {{ old('type', $information->type) == 'task' ? 'selected' : '' }}>Tugas</option>
                                            <option value="info" {{ old('type', $information->type) == 'info' ? 'selected' : '' }}>Informasi</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Deskripsi Informasi -->
                                <div class="col-md-6 col-12 mb-3">
                                    <div class="form-group d-flex">
                                        <label for="description" class="mr-2" style="width: 30%;">Deskripsi Informasi</label>
                                        <textarea class="form-control" id="description" rows="3" name="description" required>{{ old('description', $information->description) }}</textarea>
                                    </div>
                                </div>

                                <!-- Target Informasi -->
                                <div class="col-md-6 col-12 mb-3">
                                    <div class="form-group d-flex">
                                        <label for="target" class="mr-2" style="width: 30%;">Target Informasi</label>
                                        <select class="form-select" id="target" name="target" onchange="toggleDivisionInput()" required>
                                            <option value="all" {{ old('target', $information->target) == 'all' ? 'selected' : '' }}>Semua Peserta</option>
                                            <option value="division" {{ old('target', $information->target) == 'division' ? 'selected' : '' }}>Divisi Tertentu</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tanggal Mulai -->
                                <div class="col-md-6 col-12 mb-3">
                                    <div class="form-group d-flex">
                                        <label for="start_date" class="mr-2" style="width: 30%;">Tanggal Mulai</label>
                                        <input type="date" id="start_date" class="form-control" name="start_date" value="{{ old('start_date', $information->start_date) }}" required>
                                    </div>
                                </div>

                                <!-- Tanggal Selesai -->
                                <div class="col-md-6 col-12 mb-3">
                                    <div class="form-group d-flex">
                                        <label for="end_date" class="mr-2" style="width: 30%;">Tanggal Selesai</label>
                                        <input type="date" id="end_date" class="form-control" name="end_date" value="{{ old('end_date', $information->end_date) }}" required>
                                    </div>
                                </div>

                                 <!-- Division Input (Visible if target is division) -->
                                 <div id="division_input" style="{{ old('target', $information->target) == 'division' ? 'display:block' : 'display:none' }}">
                                    <div class="col-md-6 col-12 mb-3">
                                        <div class="form-group d-flex">
                                            <label for="division_id" class="mr-2" style="width: 30%;">Divisi</label>
                                            <select class="form-select" id="division_id" name="division_id">
                                                <option value="">-- Pilih Divisi --</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" {{ old('division_id', $information->division_id) == $division->id ? 'selected' : '' }}>
                                                        {{ $division->division_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dokumen -->
                                <div class="col-md-6 col-12 mb-3">
                                    <div class="form-group d-flex">
                                        <label for="document" class="mr-2" style="width: 30%;">Dokumen</label>
                                        <input type="file" id="document" class="form-control" name="document">
                                    </div>
                                    @if ($information->document)
                                        <p>Dokumen yang ada: <a href="{{ asset('storage/' . $information->document) }}" target="_blank">Lihat</a></p>
                                    @endif
                                </div>

                                <!-- Submit and Reset buttons -->
                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>

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
