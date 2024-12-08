<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Peserta</h3>
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

    <div class="row mb-3">
        <div class="col-2">
            <a href="{{ route('internQueue.index') }}" type="submit" class="btn icon icon-left btn-primary w-100">
                <i class="bi bi-arrow-left-circle"></i>
                Kembali Ke Antrian
            </a>
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
                @php
                    $number = 1;
                @endphp
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Sekolah</th>
                            <th>No. Handphone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($interns as $item)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->school_name }}</td>
                                <td>{{ $item->phone_number }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</x-main-layout>
