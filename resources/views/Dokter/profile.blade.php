@extends('layouts.app')

@section('title', 'Profil Dokter')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profil Dokter</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body text-center">
                    @if($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}" alt="Foto Dokter" width="150" class="img-thumbnail rounded-circle mb-3">
                    @else
                        <img src="{{ asset('default-avatar.png') }}" alt="Default" width="150" class="img-thumbnail rounded-circle mb-3">
                    @endif

                    <h4>{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }} | {{ $user->phone }}</p>
                    <a href="{{ route('doctor.complete-profile') }}" class="btn btn-warning">Edit Profil</a>
                    <hr>

                    <div class="text-left mt-4">
                        <p><strong>Spesialisasi:</strong> {{ $doctor->specialization }}</p>
                        <p><strong>Pendidikan:</strong> {{ $doctor->education ?? '-' }}</p>
                        <p><strong>Tempat Praktek:</strong> {{ $doctor->practice_place ?? '-' }}</p>
                        <p><strong>Deskripsi:</strong> {{ $doctor->description ?? '-' }}</p>
                        <p><strong>No STR/SIP:</strong> {{ $doctor->license_number }}</p>
                        <p><strong>Status Konsultasi:</strong> 
                            {{ $doctor->is_in_consultation ? 'Sedang Konsultasi' : 'Tidak Konsultasi' }}
                        </p>
                        <p><strong>Rating Rata-rata:</strong> {{ $doctor->average_rating }}/5</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
