@extends('layouts.app')

@section('title', 'Jadwal Praktek Dokter')

@push('style')
<!-- CSS Libraries -->
<style>
    .table {
        min-width: 300px;
    }
    .table th, .table td {
        white-space: nowrap;
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Jadwal Praktek Dokter</h1>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Jadwal Praktek</h4>
                    <div class="card-header-action">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahJadwal">
                            + Jadwal
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <!-- Alert Success -->
                        @if(Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <!-- Alert Delete -->
                        @if(Session::get('delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('delete')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <table class="table-striped mb-0 table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Hari</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->date }}</td>
                                    <td>{{ $row->day }}</td>
                                    <td>{{ $row->start_time }}</td>
                                    <td>{{ $row->end_time }}</td>
                                    <td>
                                        <div class="d-flex flex-row gap-1" style="gap: 6px;">
                                            <button type="button" class="btn btn-warning btn-action" data-toggle="modal" data-target="#editJadwal{{ $row->id }}" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <form action="{{ route('dokter.schedules.destroy', $row->id)}}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-action" title="Hapus" onclick="return confirm('Yakin hapus jadwal?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if($schedules->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada jadwal.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Modal Tambah Jadwal --}}
<div class="modal fade" tabindex="-1" role="dialog" id="tambahJadwal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('dokter.schedules.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal Praktek</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                    <div class="form-group">
                        <label>Hari</label>
                        <input type="text" class="form-control" name="day" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="time" class="form-control" name="start_time" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Selesai</label>
                        <input type="time" class="form-control" name="end_time" required>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Jadwal --}}
@foreach($schedules as $row)
<div class="modal fade" id="editJadwal{{ $row->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('dokter.schedules.update', $row->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Jadwal Praktek</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="date" value="{{ $row->date }}" required>
                    </div>
                    <div class="form-group">
                        <label>Hari</label>
                        <input type="text" class="form-control" name="day" value="{{ $row->day }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="time" class="form-control" name="start_time" value="{{ $row->start_time }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Selesai</label>
                        <input type="time" class="form-control" name="end_time" value="{{ $row->end_time }}" required>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<!-- JS Libraries -->
<script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
@endpush