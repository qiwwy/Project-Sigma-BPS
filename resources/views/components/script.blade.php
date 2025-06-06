<script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
<script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
<script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/compiled/js/app.js') }}"></script>
<!-- Need: Apexcharts -->
<script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/static/js/sweetalert2.all.min.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- //update accept_stat --}}
<script>
    $(document).on('click', '.status-toggle', function(e) {
        e.preventDefault();

        var internRegisterId = $(this).data('id');
        var $badge = $(this).find('.badge');

        $.ajax({
            url: "{{ route('internRegister.updateStatus') }}",
            type: "POST",
            data: {
                id: internRegisterId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $badge.text(response.status);

                // Ganti kelas badge berdasarkan status
                if (response.status === "Accept") {
                    $badge.removeClass('bg-warning').addClass('bg-success');
                } else if (response.status === "Reject") {
                    $badge.removeClass('bg-warning').addClass('bg-danger');
                } else {
                    $badge.removeClass('bg-success bg-danger').addClass('bg-warning');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Untuk debugging jika ada error
            }
        });
    });

    //Modal dinamis untuk detail logbook peserta
    $(document).ready(function() {
        // Ketika modal dibuka
        $('#detailLogbook').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var logbookId = button.data('id'); // ID yang diteruskan dari tombol
            console.log('Logbook ID:', logbookId); // Debugging ID

            $.ajax({
                url: '/logbook/detail/' +
                    logbookId, // Endpoint untuk mengambil detail logbook
                method: 'GET',
                success: function(response) {
                    console.log('Data berhasil diterima:',
                        response);
                    $('#date-logbook').html(
                        ` <h5 class="modal-title" id="exampleModalLabel">Detail Logbook : ${response.date_logbook}</h5>`
                    );
                    $('#modal-body').html(
                        `<div class="modal-body">
                    <!-- Judul Kegiatan -->
                    <label>Judul Kegiatan</label>
                    <div class="form-group">
                        <input type="text" class="form-control" disabled placeholder="${response.title}">
                    </div>

                    <!-- Deskripsi Kegiatan -->
                    <label class="form-label">Deskripsi Kegiatan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled placeholder="${response.job_description}"></textarea>

                    <!-- Tambahkan margin-bottom untuk memberikan jarak lebih besar -->
                    <div class="mb-3"></div> <!-- Spasi tambahan -->

                    <!-- Presentase Pengerjaan -->
                    <label for="completion_stat" class="form-label">Presentase Pengerjaan</label>
                    <div class="form-group d-flex">
                        <input type="radio" class="btn-check" name="completion_stat" id="completion_stat_25" autocomplete="off"
                            value="25" ${response.completion_stat == 25 ? 'checked' : ''} disabled>
                        <label class="btn btn-outline-success" for="completion_stat_25">25 %</label>

                        <input type="radio" class="btn-check" name="completion_stat" id="completion_stat_50" autocomplete="off"
                            value="50" ${response.completion_stat == 50 ? 'checked' : ''} disabled>
                        <label class="btn btn-outline-success" for="completion_stat_50">50 %</label>

                        <input type="radio" class="btn-check" name="completion_stat" id="completion_stat_75" autocomplete="off"
                            value="75" ${response.completion_stat == 75 ? 'checked' : ''} disabled>
                        <label class="btn btn-outline-success" for="completion_stat_75">75 %</label>

                        <input type="radio" class="btn-check" name="completion_stat" id="completion_stat_100" autocomplete="off"
                            value="100" ${response.completion_stat == 100 ? 'checked' : ''} disabled>
                        <label class="btn btn-outline-success" for="completion_stat_100">100 %</label>
                    </div>

                        <!-- Progress Pekerjaan -->
                        <label for="exampleFormControlTextarea1" class="form-label">Progress Pekerjaan</label>
                        <div class="progress progress-primary mb-4">
                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: ${response.completion_stat}%"
                                aria-valuenow="${response.completion_stat}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <!-- Waktu Pengerjaan -->
                        <label for="processing_time" class="form-label">Waktu Pengerjaan</label>
                        <div class="form-group">
                            <input type="text" class="form-control" disabled placeholder="${response.processing_time}">
                        </div>

                        <!-- Tugas Dari -->
                        <label>Tugas Dari</label>
                        <div class="form-group">
                            <input type="text" class="form-control" disabled placeholder="${response.divisi}">
                        </div>
                    </div>`
                    );
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error); // Debugging error
                    $('#logbook-detail-content').html('<p>Error loading details.</p>');
                }
            });
        });
    });

    // Ketika modal edit dibuka, isi field dengan data yang sesuai
    $('#editSchoolModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var schoolId = button.data('school-id'); // Ambil ID sekolah
        var schoolName = button.data('school-name'); // Ambil nama sekolah
        var typeSchool = button.data('type-school'); // Ambil jenis sekolah

        var modal = $(this);
        modal.find('#edit_school_name').val(schoolName); // Isi input dengan nama sekolah
        modal.find('#edit_type_school').val(typeSchool); // Isi select dengan jenis sekolah

        // Ubah action form dengan route yang sesuai
        var formAction = "{{ route('schools.update', ':id') }}";
        formAction = formAction.replace(':id', schoolId);
        modal.find('#editSchoolForm').attr('action', formAction); // Atur action form ke URL yang benar
    });

    $('#editDivisionModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var divisionId = button.data('division-id'); // Ambil ID sekolah
        var divisionName = button.data('division-name'); // Ambil nama sekolah

        var modal = $(this);
        modal.find('#edit_division_name').val(divisionName); // Isi input dengan nama sekolah

        // Ubah action form dengan route yang sesuai
        var formAction = "{{ route('divisions.update', ':id') }}";
        formAction = formAction.replace(':id', divisionId);
        modal.find('#editDivisionForm').attr('action', formAction); // Atur action form ke URL yang benar
    });

    $('#editDispositionModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var internId = button.data('intern-id'); // Ambil ID intern
        var divisionId = button.data('division-id'); // Ambil ID divisi

        var modal = $(this);
        modal.find('#division_id').val(divisionId); // Pilih option yang sesuai di dropdown

        // Ubah action form dengan route yang sesuai
        var formAction = "{{ route('monitoring.disposition.update', ':id') }}";
        formAction = formAction.replace(':id', internId);
        modal.find('#editDispositionForm').attr('action', formAction); // Set action form ke URL yang benar
    });

    $('#editPointModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Mendapatkan tombol yang memicu modal
        var logbookId = button.data('logbook-id'); // Mengambil ID logbook dari data-logbook-id
        var point = button.data('logbook-point'); // Mengambil nilai point dari data-logbook-point

        var modal = $(this);
        modal.find('#edit_point_id').val(point); // Menyeting nilai point ke dalam form select
        modal.find('#editPointForm').attr('action', '/mentor/point-logbook/' +
        logbookId); // Mengganti URL action form dengan ID logbook
    });

    $(document).on('submit', '#editPointForm', function(e) {
        e.preventDefault(); // Mencegah pengiriman form secara default

        let form = $(this);
        let url = form.attr('action'); // Dapatkan URL action dari form
        let data = form.serialize(); // Serialisasi data form

        $.ajax({
            url: url,
            type: 'PUT',
            data: data,
            success: function(response) {
                // Tampilkan notifikasi sukses dengan SweetAlert
                Swal.fire({
                    icon: "success",
                    title: "Aktifitas Berhasil Di Nilai",
                    text: response.success,
                    confirmButtonText: "OK",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#editPointModal').modal('hide'); // Tutup modal
                        location.reload(); // Reload halaman
                    }
                });
            },
            error: function(xhr) {
                // Tangani error
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: xhr.responseJSON?.message || "Terjadi kesalahan!",
                });
            }
        });
    });

    $('#editInformationModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var informationId = button.data('information-id'); // Ambil ID intern
        var divisionId = button.data('division-id'); // Ambil ID divisi
        var title = button.data('title'); // Ambil judul
        var description = button.data('description'); // Ambil deskripsi

        var modal = $(this);
        modal.find('#division_id').val(divisionId); // Pilih option yang sesuai di dropdown
        modal.find('#title').val(title); // Isi field judul
        modal.find('#description').val(description); // Isi field deskripsi

        // Ubah action form dengan route yang sesuai
        var formAction = "{{ route('monitoring.information.update', ':id') }}";
        formAction = formAction.replace(':id', informationId);
        modal.find('#editInformatiionForm').attr('action', formAction); // Set action form ke URL yang benar
    });
</script>
