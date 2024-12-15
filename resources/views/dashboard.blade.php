<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row align-items-center mt-4 mb-3">
                <div class="col-12 col-md-6 text-left">
                    <h2 class="mb-0">Selamat datang {{ session('intern')->name }}
                    </h2>
                </div>
                <div class="col-12 col-md-3 text-center">
                    <!-- Tombol Absen Masuk -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#absenModal" class="btn btn-primary btn-block"
                        onclick="setAbsenType('masuk')">Absen Masuk</a>
                </div>
                <div class="col-12 col-md-3 text-center">
                    <!-- Tombol Absen Pulang -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#absenModal"
                        class="btn btn-danger btn-block" onclick="setAbsenType('pulang')">Absen Pulang</a>
                </div>
            </div>
        </div>

        <div class="section mt-4">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Precense Details</h4>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Task Details</h4>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Logbook Details</h4>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="absenModal" tabindex="-1" role="dialog" aria-labelledby="absenModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="absenModalLabel">Lakukan Presensi Disini</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk Presensi -->
                    <form action="{{ route('activity.presence.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="type">Jenis Presensi</label>
                        <!-- Input untuk Tipe Presensi secara otomatis -->
                        <input type="hidden" name="type" id="typeField" value="">
                        <div class="input-group" style="flex: 1;">
                            <select class="form-select" id="inputGroupSelect01" name="type" disabled
                                style="flex: 1;">
                                <option value="masuk">Presensi Masuk</option>
                                <option value="pulang">Presensi Pulang</option>
                            </select>
                            <label class="input-group-text" for="inputGroupSelect01">Tipe</label>
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

    <script>
        function setAbsenType(type) {
            // Set value dari field type di form sesuai dengan tombol yang diklik
            document.getElementById('typeField').value = type;

            // (Optional) Update dropdown jika Anda ingin dropdown tetap sinkron
            const dropdown = document.getElementById('inputGroupSelect01');
            dropdown.value = type; // Ubah dropdown sesuai dengan value type
        }
    </script>
</x-main-layout>
