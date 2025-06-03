@extends('layouts.app')

@section('title', 'Dashboard Layanan Kesehatan')

@push('style')
<link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
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
            <h1>Dashboard Layanan Kesehatan</h1>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Layanan Kesehatan</h4>
                    <div class="card-header-action">
                        {{-- Ganti modal dengan link ke halaman create --}}
                        <a href="{{ route('create.layanan') }}" class="btn btn-primary">
                            + Layanan
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        @if(Session::get('Sukses'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('Sukses') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(Session::get('Delete'))
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
                                    <th>Nama Layanan</th>
                                    <th>Tempat Layanan</th>
                                    <th>Deskripsi</th>
                                    <th>Lokasi</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($serviceSchedules as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->service_name }}</td>
                                    <td>{{ $row->service_place ?? '-' }}</td>
                                    <td>{{ Str::limit($row->service_description, 50) ?? '-' }}</td>
                                    <td>{{ $row->location->name ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->date)->format('d M Y') }}</td>
                                    <td>{{ $row->time_start }} - {{ $row->time_end }}</td>
                                    <td>
                                        {{-- Ganti modal dengan link ke halaman edit --}}
                                        <a href="{{ route('edit.layanan', $row->id) }}" class="btn btn-warning btn-action">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('delete.layanan', $row->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Hapus layanan ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection