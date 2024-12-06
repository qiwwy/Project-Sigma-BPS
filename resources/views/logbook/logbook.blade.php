<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Logbook Harian {{ session('intern')->name }} 📖</h3>
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
                    Logbook Anda
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
                            <th>Tanggal</th>
                            <th>Judul Pekerjaan</th>
                            <th>Presentase Penyelesaian</th>
                            <th>Pemberi Tugas</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($logbookInterns as $item)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ $item->date_logbook }}</td>
                                <td>{{ $item->title ?? 'Judul pekerjaan masih kosong...' }}</td>
                                <td>{{ $item->completion_stat ?? 'Waktu dibutuhkan masih kosong...' }}</td>
                                <td>{{ $item->divisi ?? 'Pemberi tugas masih kosong...' }}</td>
                                <td>
                                    <span
                                        class="badge
                                                 @if ($item->accept_stat === 'Pending') bg-warning
                                                 @elseif($item->accept_stat === 'Accept') bg-success
                                                 @elseif($item->accept_stat === 'Reject') bg-danger @endif">
                                        {{ $item->accept_stat }}
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary"
                                        style="@if (empty($item->title) ||
                                                empty($item->job_description) ||
                                                empty($item->completion_stat) ||
                                                empty($item->processing_time) ||
                                                empty($item->divisi)) visibility: hidden; @endif"
                                        data-bs-toggle="modal" data-bs-target="#detailLogbook"
                                        data-id="{{ $item->id }}">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('logbookIntern.edit', $item->id) }}" class="btn btn-success">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal detail view --}}
        <div class="modal fade" id="detailLogbook" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="date-logbook"></div>
                    </div>
                    <div class="modal-body" id="modal-body">
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
