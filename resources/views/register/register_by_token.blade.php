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
                                <th>Total Waktu</th>
                                <th>Status Penerimaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>{{ $internRegister->identity_number }}</td>
                                <td>{{ $internRegister->name }}</td>
                                <td>{{ $internRegister->school_name }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($internRegister->start_date)->format('d-m-Y') }} -
                                    {{ \Carbon\Carbon::parse($internRegister->end_date)->format('d-m-Y') }}
                                </td>
                                <td>
                                    @php
                                        $startDate = \Carbon\Carbon::parse($internRegister->start_date);
                                        $endDate = \Carbon\Carbon::parse($internRegister->end_date);
                                        $daysDifference = $startDate->diffInDays($endDate);
                                    @endphp
                                    {{ $daysDifference }} Hari
                                </td>
                                <td>{{ $internRegister->accept_stat }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
