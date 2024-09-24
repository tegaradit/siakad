@extends('layouts.home-layout')

@section('home-content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="wrapper">
                <div class="container my-5">
                    <h3 class="mb-3">Data Identitas Perguruan Tinggi</h3>

                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- Edit NPSN Modal Trigger -->
                    <button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#editNpsnModal">
                        Edit NPSN
                    </button>

                    @if(isset($educationalUnit))
                    <!-- Display Educational Unit Data -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Perguruan Tinggi</th>
                                    <td>{{ $educationalUnit->nm_lemb ?? '-' }}</td>
                                    <th>Nama Singkat</th>
                                    <td>{{ $educationalUnit->nm_singkat ?? '-' }}</td>
                                    <th>NPSN</th>
                                    <td>{{ $educationalUnit->npsn ?? '-' }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6"></td>
                                </tr>
                                <tr>
                                    <th>Jalan</th>
                                    <td>{{ $educationalUnit->jln ?? '-' }}</td>
                                    <th>RT/RW</th>
                                    <td>{{ $educationalUnit->rt ?? '-' }}/{{ $educationalUnit->rw ?? '-' }}</td>
                                    <th>Kode Pos</th>
                                    <td>{{ $educationalUnit->kode_pos ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Koordinat Lintang</th>
                                    <td>{{ $educationalUnit->lintang ?? '-' }}</td>
                                    <th>Bujur</th>
                                    <td>{{ $educationalUnit->bujur ?? '-' }}</td>
                                    <th>No. Telp</th>
                                    <td>{{ $educationalUnit->no_tel ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>No. Fax</th>
                                    <td>{{ $educationalUnit->no_fax ?? '-' }}</td>
                                    <th>Email</th>
                                    <td>{{ $educationalUnit->email ?? '-' }}</td>
                                    <th>Website</th>
                                    <td><a href="{{ $educationalUnit->website ?? '#' }}">{{ $educationalUnit->website ?? '-' }}</a></td>
                                </tr>
                                <tr>
                                    <th>Status SP</th>
                                    <td>{{ $educationalUnit->stat_sp ?? '-' }}</td>
                                    <th>SK. Pendirian</th>
                                    <td>{{ $educationalUnit->sk_pendirian_sp ?? '-' }}</td>
                                    <th>Tgl. SK. Pendirian</th>
                                    <td>{{ $educationalUnit->tgl_sk_pendirian_sp ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tgl. Berdiri</th>
                                    <td>{{ $educationalUnit->tgl_berdiri ?? '-' }}</td>
                                    <th>SK. Izin Operasi</th>
                                    <td>{{ $educationalUnit->sk_izin_operasi ?? '-' }}</td>
                                    <th>Tgl. SK. Izin Operasi</th>
                                    <td>{{ $educationalUnit->tgl_sk_izin_operasi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>No. Rekening</th>
                                    <td>{{ $educationalUnit->no_rek ?? '-' }}</td>
                                    <th>Nama Rekening</th>
                                    <td>{{ $educationalUnit->nm_rek ?? '-' }}</td>
                                    <th>Nama Bank</th>
                                    <td>{{ $educationalUnit->nm_bank ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Unit Cabang</th>
                                    <td>{{ $educationalUnit->unit_cabang ?? '-' }}</td>
                                    <th>Luas Tanah Milik</th>
                                    <td>{{ $educationalUnit->luas_tanah_milik ?? '0' }} m²</td>
                                    <th>Luas Tanah Bukan Milik</th>
                                    <td>{{ $educationalUnit->luas_tanah_bukan_milik ?? '0' }} m²</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p>No data available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit NPSN Modal -->
<div class="modal fade" id="editNpsnModal" tabindex="-1" aria-labelledby="editNpsnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNpsnModalLabel">Edit NPSN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editNpsnForm" action="{{ route('identitas-pt.update') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="newNpsn" class="form-label">NPSN</label>
                        <input type="text" class="form-control" id="newNpsn" name="npsn" value="{{ request('npsn', '053025') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update NPSN</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Trigger fetch data on page load if input is empty
    window.addEventListener('DOMContentLoaded', (event) => {
        const npsnInput = document.getElementById('newNpsn');
        // if (npsnInput) {
        //     document.getElementById('editNpsnForm').submit();
        // }
    });
</script>
@endsection