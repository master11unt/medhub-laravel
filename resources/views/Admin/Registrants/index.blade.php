@extends('layouts.app')

@section('title', 'Daftar Pendaftar')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Daftar Pendaftar</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Data Pendaftar</h4>
                    <div class="card-header-action">
                        <a href="{{ route('create.pendaftar') }}" class="btn btn-primary">
                            + Tambah Pendaftar
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>No Identitas</th>
                                    <th>Riwayat Penyakit</th>
                                    <th>Catatan Khusus</th>
                                    <th>Persetujuan</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($registrants as $index => $r)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $r->full_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($r->birth_date)->translatedFormat('d M Y') }}</td>
                                        <td>{{ $r->gender }}</td>
                                        <td>{{ $r->address }}</td>
                                        <td>{{ $r->phone_number }}</td>
                                        <td>{{ $r->identity_number ?? '-' }}</td>
                                        <td>{{ $r->has_medical_history }}</td>
                                        <td>{{ $r->special_notes ?? '-' }}</td>
                                        <td>{{ $r->agreement ? 'Setuju' : 'Tidak Setuju' }}</td>
                                        <td>
                                            <a href="{{ route('edit.pendaftar', $r->id) }}" class="btn btn-warning btn-sm mb-2 mt-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('delete.pendaftar', $r->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm mb-2">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Belum ada data pendaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection