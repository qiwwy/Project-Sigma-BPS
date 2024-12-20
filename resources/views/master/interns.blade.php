<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Pendaftar Magang</h3>
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
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        List Data
                    </h5>
                </div>
                <div class="card-body">
                    @if (session('successDisposition'))
                        <div class="alert alert-light-success color-success">
                            {{ session('successDisposition') }}
                        </div>
                    @endif
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIS/NIM</th>
                                <th>Nama</th>
                                <th>Asal Sekolah</th>
                                <th>Divisi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $number = 1;
                            @endphp
                            @foreach ($interns as $item)
                                <tr>
                                    <td>{{ $number++ }}</td>
                                    <td>{{ $item->identity_number }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->school_name }}</td>
                                    <td>
                                        @if ($item->division->division_name === 'P3SDI')
                                            <span class="badge bg-primary">{{ $item->division->division_name }}</span>
                                        @elseif ($item->division->division_name === 'Teknis')
                                            <span class="badge bg-danger">{{ $item->division->division_name }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $item->division->division_name }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="">
                                                <span class="badge bg-primary">
                                                    <i class="bi bi-eye-fill"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="">
                                                <span class="badge bg-warning">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="">
                                                <span class="badge bg-danger">
                                                    <i class="bi bi-trash-fill"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-main-layout>
