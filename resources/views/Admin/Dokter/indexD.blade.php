@extends('layouts.app')

@section('title', 'Dashboard Dokter')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">

<style>
    .table {
        min-width: 1300px;
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
            <h1>Dashboard Dokter</h1>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Dokter</h4>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <!-- Alert Success -->
                        @if(Session::get('Sukses'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('Sukses') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <!-- Alert Delete -->
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
                                    <th>Foto</th>
                                    <th>Nama Dokter</th>
                                    <th>Spesialisasi</th>
                                    <th>Pendidikan</th>
                                    <th>Tempat Praktek</th>
                                    <th>No. Lisensi</th>
                                    <th>Spesialis</th>
                                    <th>Status Konsultasi</th>
                                    <th>Rating Rata-rata</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($doctors as $doctor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($doctor->user->image)
                                            <img src="{{ asset('storage/' . $doctor->user->image) }}" width="60">
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                    <td>{{ $doctor->user->name ?? '-' }}</td>
                                    <td>{{ $doctor->specialization }}</td>
                                    <td>{{ $doctor->education }}</td>
                                    <td>{{ $doctor->practice_place }}</td>
                                    <td>{{ $doctor->license_number }}</td>
                                    <td>
                                        {{ $doctor->is_specialist ? 'Dokter Spesialis' : 'Dokter Umum' }}
                                    </td>
                                    <td>
                                        <button 
                                            class="btn {{ $doctor->is_in_consultation ? 'btn-warning' : 'btn-success' }}">
                                            {{ $doctor->is_in_consultation ? 'Sedang Konsultasi' : 'Tidak Konsultasi' }}
                                        </button>
                                    </td>
                                    <td>{{ number_format($doctor->average_rating, 2) }}</td>
                                    <td>
                                        <a href="{{ route('admin.edit.dokter', $doctor->id) }}" class="btn btn-warning btn-sm">Edit</a>
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
