<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row align-items-center mt-4 mb-3">
                <div class="col-12 col-md-6 text-left">
                    <h2 class="mb-0">Selamat datang {{ session('intern')->name }}</h2>
                </div>
                @if (session('intern')->role === 'intern')
                    <div class="col-12 col-md-6 text-end">
                        <!-- Tombol di pojok kanan -->
                        <form action="{{ route('activity.presence.store') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block">
                                Silahkan Presensi Disini
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>


        @php
            $divisions = \App\Models\Division::withCount([
                'interns' => function ($query) {
                    $query->where('status', 'Active');
                },
            ])->get();
        @endphp

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "Berhasil!",
                        text: "{{ session('success') }}",
                        icon: "success",
                        draggable: true
                    });
                });
            </script>
        @elseif ($errors->has('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "Gagal!",
                        text: " {{ $errors->first('error') }}",
                        icon: "error",
                        draggable: true
                    });
                });
            </script>
        @endif

        @if (session('intern')->role === 'admin')
            <div class="section mt-4">
                <div class="row">
                    <div class="row">
                        @foreach ($divisions as $division)
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Divisi:
                                            @if ($division->division_name === 'P3SDI')
                                                <span class="badge bg-primary">{{ $division->division_name }}</span>
                                            @elseif ($division->division_name === 'Teknis')
                                                <span class="badge bg-danger">{{ $division->division_name }}</span>
                                            @else
                                                <span class="badge bg-success">{{ $division->division_name }}</span>
                                            @endif
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <p>Jumlah Peserta: {{ $division->interns_count }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-main-layout>
