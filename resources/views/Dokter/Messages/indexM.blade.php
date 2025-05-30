@extends('layouts.app')

@section('title', 'Daftar Konsultasi')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Daftar Konsultasi</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Pasien Konsultasi</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Pasien</th>
                                <th>Tanggal Konsultasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consultations as $consultation)
                            <tr>
                                <td>{{ $consultation->user->name }}</td>
                                <td>{{ $consultation->consultation_date }}</td>
                                <td>{{ ucfirst($consultation->status) }}</td>
                                <td>
                                    <a href="{{ route('dokter.consultations.chat', $consultation->id) }}" class="btn btn-primary btn-sm">Lihat Chat</a>
                                </td>
                            </tr>
                            @endforeach
                            @if($consultations->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">Belum ada konsultasi.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection