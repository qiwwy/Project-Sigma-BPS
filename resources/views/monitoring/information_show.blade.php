<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Informasi</h3>
                    <p class="text-subtitle text-muted">Detail dari informasi yang Anda pilih.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-2">
            <a href="{{ route('monitoring.information.index') }}" type="submit" class="btn icon icon-left btn-primary w-100">
                <i class="bi bi-arrow-left-circle"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $information->title }}</h5>
                </div>
                <div class="card-body">
                    <form>
                        @csrf
                        <div class="row">
                            <!-- Type Kolom Kiri -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="type" class="form-label"><strong>Tipe</strong></label>
                                <input type="text" class="form-control" id="type" value="{{
                                    $information->type === 'event' ? 'Acara' :
                                    ($information->type === 'task' ? 'Tugas' :
                                    ($information->type === 'info' ? 'Informasi' : '')) }}" readonly>
                            </div>

                            <!-- Document Kolom Kanan -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="document" class="form-label"><strong>Dokumen</strong></label>
                                <input type="text" class="form-control" id="document" value="{{ $information->document ? 'Tersedia' : 'Tidak ada dokumen' }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label"><strong>Deskripsi</strong></label>
                            <textarea class="form-control" id="description" rows="4" readonly>{{ $information->description }}</textarea>
                        </div>
                        <div class="row">
                            <!-- Divisi Kolom Kiri -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="division_id" class="form-label"><strong>Divisi</strong></label>
                                <input type="text" class="form-control" id="division_id" value="{{
                                    $information->division_id === null ? 'Semua Peserta' :
                                    ($information->division_id === 1 ? 'P3SDI' :
                                    ($information->division_id === 2 ? 'Teknis' :
                                    ($information->division_id === 3 ? 'Sub Bagian Umum' : '')) ) }}" readonly>
                            </div>
                            <!-- Target Kolom Kanan -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="target" class="form-label"><strong>Target</strong></label>
                                <input type="text" class="form-control" id="target" value="{{ $information->target }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Start Date Kolom Kiri -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="start_date" class="form-label"><strong>Tanggal Mulai</strong></label>
                                <input type="text" class="form-control" id="start_date" value="{{ \Carbon\Carbon::parse($information->start_date)->format('d M Y') }}" readonly>
                            </div>

                            <!-- End Date Kolom Kanan -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="end_date" class="form-label"><strong>Tanggal Selesai</strong></label>
                                <input type="text" class="form-control" id="end_date" value="{{ \Carbon\Carbon::parse($information->end_date)->format('d M Y') }}" readonly>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
