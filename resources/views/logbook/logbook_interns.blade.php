<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Logbook Peserta</h3>
                    <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies
                        thanks to simple-datatables.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end">
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

    <section class="section">
        @php
            $interns = \App\Models\Interns::where('status', 'Active')->whereNotNull('division_id')->get();
        @endphp
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h5 class="card-title">List Data Logbook</h5>
                <div class="mt-2 d-flex justify-content-end">
                    <form action="{{ route('cetak.logbook.intern.export') }}" method="GET" class="d-flex align-items-center gap-2">
                        <select class="form-select w-auto" name="intern_id" required>
                            <option value="">-- Pilih Peserta --</option>
                            @foreach ($interns as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-printer"></i> Cetak
                        </button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                @php
                    $number = 1;
                @endphp

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIM Peserta</th>
                            <th>Asal Sekolah</th>
                            <th>Jumlah Logbook</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logbookCounts as $logbook)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ $logbook['name'] }}</td>
                                <td>{{ $logbook['school_name'] }}</td>
                                <td>{{ $logbook['filled_logbook_count'] }} / {{ $logbook['total_logbook_count'] }}</td>
                                <td>
                                    <a href="{{ route('logbookIntern.showDetailLogbook', ['intern_id' => $logbook['intern_id']]) }}"
                                        class="badge bg-primary">
                                        <i class="bi bi-eye-fill"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="modal fade" id="cetakLogbookIntern" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printModalLabel">Pilih Peserta Magang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="printForm">
                        <div class="mb-3">
                            <label for="internSelect" class="form-label">Pilih Peserta Magang:</label>
                            <select class="form-select" id="internSelect" name="intern_id">
                                <option value="">-- Pilih Peserta --</option>
                                @foreach ($interns as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="printLogbook()">Cetak</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printLogbook() {
            let internId = document.getElementById("internSelect").value;
            console.log("Intern ID terpilih:", internId); // Debugging
            if (internId) {
                window.location.href = `/logbooks-intern-export?intern_id=${internId}`;
            } else {
                alert("Silakan pilih peserta magang terlebih dahulu!");
            }
        }
    </script>
</x-main-layout>
