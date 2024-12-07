<script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
<script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
<script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/compiled/js/app.js') }}"></script>
<!-- Need: Apexcharts -->
<script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>

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
</script>
