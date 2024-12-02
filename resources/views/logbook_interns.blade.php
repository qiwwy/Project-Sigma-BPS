<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Logbook Peserta</h3>
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

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    List Data Logbook
                </h5>
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
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($logbookCounts as $logbook)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ $logbook['name'] }}</td>
                                <td>{{ $logbook['school_name'] }}</td>
                                <td>{{ $logbook['filled_logbook_count'] }} / {{ $logbook['total_logbook_count'] }}</td>
                                <td>
                                    <a href="{{ route('logbookIntern.showDetailLogbook', ['intern_id' => $logbook['intern_id']]) }}"
                                        class="btn btn-primary">
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
</x-main-layout>
