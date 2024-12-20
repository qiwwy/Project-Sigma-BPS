<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Isi Logbook Anda Disini</h3>
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
        </div>
    </div>

    <section class="section">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Logbook Hari Ini</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{ route('mentor.updatePoint', $logbook->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Tanggal Pengisian -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group d-flex">
                                        <label for="date_logbook" class="mr-2" style="width: 30%;">Tanggal Pengisian</label>
                                        <input type="text" id="id_date_logbook" class="form-control" style="flex: 1;" name="date_logbook" value="{{ old('date_logbook', $logbook->date_logbook) }}" readonly>
                                    </div>
                                </div>

                                <!-- Waktu Pengerjaan -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="processing_time" class="mr-2" style="width: 30%;">Waktu Pengerjaan</label>
                                        <select class="form-select" name="processing_time" style="flex: 1;" readonly disabled>
                                            <option value="1" {{ old('processing_time', $logbook->processing_time) == 1 ? 'selected' : '' }}>Kurang dari 1 Jam</option>
                                            <option value="2" {{ old('processing_time', $logbook->processing_time) == 2 ? 'selected' : '' }}>1 Jam - 3 Jam</option>
                                            <option value="3" {{ old('processing_time', $logbook->processing_time) == 3 ? 'selected' : '' }}>3 Jam - 5 Jam</option>
                                            <option value="4" {{ old('processing_time', $logbook->processing_time) == 4 ? 'selected' : '' }}>5 Jam - 8 Jam</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Judul Kegiatan -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group d-flex">
                                        <label for="title" class="mr-2" style="width: 30%;">Judul Kegiatan</label>
                                        <input type="text" id="id_title" class="form-control" style="flex: 1;" name="title" value="{{ old('title', $logbook->title) }}" readonly>
                                    </div>
                                </div>

                                <!-- Presentase Pengerjaan -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="completion_stat" class="mr-2" style="width: 30%;">Presentase Pengerjaan</label>
                                        <div class="d-flex" readonly>
                                            <input type="radio" class="btn-check" name="completion_stat" id="completion_stat_25" value="25" {{ old('completion_stat', $logbook->completion_stat) == 25 ? 'checked' : '' }} disabled>
                                            <label class="btn btn-outline-success" for="completion_stat_25">25 %</label>

                                            <input type="radio" class="btn-check" name="completion_stat" id="completion_stat_50" value="50" {{ old('completion_stat', $logbook->completion_stat) == 50 ? 'checked' : '' }} disabled>
                                            <label class="btn btn-outline-success" for="completion_stat_50">50 %</label>

                                            <input type="radio" class="btn-check" name="completion_stat" id="completion_stat_75" value="75" {{ old('completion_stat', $logbook->completion_stat) == 75 ? 'checked' : '' }} disabled>
                                            <label class="btn btn-outline-success" for="completion_stat_75">75 %</label>

                                            <input type="radio" class="btn-check" name="completion_stat" id="completion_stat_100" value="100" {{ old('completion_stat', $logbook->completion_stat) == 100 ? 'checked' : '' }} disabled>
                                            <label class="btn btn-outline-success" for="completion_stat_100">100 %</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deskripsi Kegiatan -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="job_description" class="mr-2" style="width: 30%;">Deskripsi Kegiatan</label>
                                        <textarea class="form-control" rows="3" name="job_description" style="flex: 1;" readonly>{{ old('job_description', $logbook->job_description) }}</textarea>
                                    </div>
                                </div>

                                <!-- Pemberi Tugas -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="divisi" class="mr-2" style="width: 30%;">Pemberi Tugas</label>
                                        <select class="form-select" name="divisi" style="flex: 1;" readonly disabled>
                                            <option value="1" {{ old('divisi', $logbook->divisi) == 1 ? 'selected' : '' }}>Ruang. P3SDI</option>
                                            <option value="2" {{ old('divisi', $logbook->divisi) == 2 ? 'selected' : '' }}>Ruang. Teknis</option>
                                            <option value="3" {{ old('divisi', $logbook->divisi) == 3 ? 'selected' : '' }}>Sub Bagian Umum</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Select Option Point -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="point" class="mr-2" style="width: 30%;">Point</label>
                                        <select class="form-select" name="point" style="flex: 1;">
                                            <option value="25" {{ old('point', $logbook->point) == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ old('point', $logbook->point) == 50 ? 'selected' : '' }}>50</option>
                                            <option value="75" {{ old('point', $logbook->point) == 75 ? 'selected' : '' }}>75</option>
                                            <option value="100" {{ old('point', $logbook->point) == 100 ? 'selected' : '' }}>100</option>
                                        </select>

                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
