<script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
<script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
<script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/compiled/js/app.js') }}"></script>
<!-- Need: Apexcharts -->
<script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/simple-datatables.js') }}"></script>

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
</script>
