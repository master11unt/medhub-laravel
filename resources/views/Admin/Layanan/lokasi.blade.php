@extends('layouts.app')

@section('title', 'Dashboard Lokasi')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <style>
        .table {
            min-width: 300px;
        }

        .table th,
        .table td {
            white-space: nowrap;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard Lokasi</h1>
            </div>

            <div>
                <div class="card">
                    <div class="card-header">
                        <h4>Data Lokasi</h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahLokasi">
                                + Tambah Lokasi
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            @if (Session::get('Sukses'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ Session::get('Sukses') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (Session::get('Delete'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ Session::get('Delete') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <table class="table-striped mb-0 table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lokasi</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($locations as $loc)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $loc->name }}</td>
                                            <td>{{ $loc->address }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-1">
                                                    <form action="{{ route('delete.lokasi', ['id' => $loc->id]) }}"
                                                        method="POST" style="margin-right: 5px;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-action"
                                                            onclick="return confirm('Hapus lokasi ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    <button type="button" class="btn btn-warning btn-action"
                                                        data-toggle="modal" data-target="#editLokasi{{ $loc->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit Lokasi -->
                                        <div class="modal fade" id="editLokasi{{ $loc->id }}" tabindex="-1"
                                            role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('update.lokasi', ['id' => $loc->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Lokasi</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Nama Lokasi</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ $loc->name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Alamat</label>
                                                                <textarea name="address" class="form-control">{{ $loc->address }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-whitesmoke br">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Tambah Lokasi -->
    <div class="modal fade" id="tambahLokasi" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('create.lokasi') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Lokasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Lokasi</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="address" class="form-control"></textarea>
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
@endsection