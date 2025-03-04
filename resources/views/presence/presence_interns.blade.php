<x-main-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Kehadiran Peserta</h3>
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
                <h5 class="card-title">List Data Kehadiran</h5>
                <div class="mt-2 d-flex justify-content-end">
                    <form action="{{ route('cetak.presence.intern.export') }}" method="GET" class="d-flex align-items-center gap-2">
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
                            <th>Nama Peserta</th>
                            <th>Asal Sekolah</th>
                            <th>Total Kehadiran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presenceData as $presence)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ $presence['name'] }}</td>
                                <td>{{ $presence['school_name'] }}</td>
                                <td>{{ $presence['total_presence_count'] }} / {{ $presence['total_days'] }}</td>
                                <td>
                                    <a href="{{ route('monitoring.presenceIntern.showDetailPresence', ['intern_id' => $presence['intern_id']]) }}"
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
</x-main-layout>
