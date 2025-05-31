@extends('layouts.app')

@section('title', 'Profil Singkat Dokter')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">

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
            <h1>Profil Singkat Dokter</h1>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Profil Dokter</h4>
                    <div class="card-header-action">
                        <!-- Add button for further action (Optional) -->
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table-striped mb-0 table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Spesialisasi</th>
                                    <th>Nomor Lisensi</th>
                                    <th>Spesialis?</th>
                                    <th>Status Online</th>
                                    <th>Status Konsultasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{ $doctor->user->name }}</td>
                                    <td>{{ $doctor->specialization }}</td>
                                    <td>{{ $doctor->license_number }}</td>
                                    <td>
                                        @if ($doctor->is_specialist)
                                            <span class="badge bg-success">Ya</span>
                                        @else
                                            <span class="badge bg-danger">Tidak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($doctor->is_online)
                                            <span class="badge bg-success">Online</span>
                                        @else
                                            <span class="badge bg-danger">Offline</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($doctor->is_in_consultation)
                                            <span class="badge bg-warning">Sedang Konsultasi</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-row gap-1" style="gap: 6px;">
                                            <form action="{{ route('dokter.updateStatus') }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                                <button type="submit" class="btn btn-warning btn-action" title="Ganti Status">
                                                    @if ($doctor->is_online) 
                                                        Offline
                                                    @else 
                                                        Online 
                                                    @endif
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraries -->
<script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('library/prismjs/prism.js') }}"></script>
@endpush
