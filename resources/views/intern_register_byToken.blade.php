<x-main-layout>
    <div class="container">
        <div class="card mt-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Informasi Pendaftaran
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIM/NIS</th>
                                <th>Nama</th>
                                <th>Asal Sekolah</th>
                                <th>Periode Magang</th>
                                <th>Status Penerimaan</th>
                                <th>Status Pendaftaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>{{ $internRegister->identity_number }}</td>
                                <td>{{ $internRegister->name }}</td>
                                <td>{{ $internRegister->school_name }}</td>
                                <td>{{ $internRegister->start_date }} - {{ $internRegister->end_date }}</td>
                                <td> <span class="badge bg-success">{{ $internRegister->accept_stat }}</span></td>
                                <td> <span class="badge bg-success">{{ $internRegister->register_stat }}</span></td>
                                <td>
                                    <div class="btn-group">
                                        <span class="badge bg-primary">Detail</span>
                                    </div>
                                    <div class="btn-group">
                                        <span class="badge bg-warning">Edit</span>
                                    </div>
                                    <div class="btn-group">
                                        <span class="badge bg-danger">Hapus</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
