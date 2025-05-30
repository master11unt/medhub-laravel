@extends('layouts.app')

@section('title', 'Edit Dokter')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Dokter</h1>
        </div>

        <div class="section-body">
            <form action="{{ route('update.dokter', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Spesialisasi</label>
                    <input type="text" name="specialization" class="form-control" value="{{ $doctor->specialization }}">
                </div>

                <div class="form-group">
                    <label>Pendidikan</label>
                    <input type="text" name="education" class="form-control" value="{{ $doctor->education }}">
                </div>

                <div class="form-group">
                    <label>Tempat Praktek</label>
                    <input type="text" name="practice_place" class="form-control" value="{{ $doctor->practice_place }}">
                </div>

                <div class="form-group">
                    <label>No. Lisensi</label>
                    <input type="text" name="license_number" class="form-control" value="{{ $doctor->license_number }}">
                </div>

                <div class="form-group">
                    <label>Rating Rata-rata</label>
                    <input type="number" step="0.01" name="average_rating" class="form-control" value="{{ $doctor->average_rating }}">
                </div>

                <div class="form-group">
                    <label>Foto Dokter (Opsional)</label><br>
                    @if($doctor->user->image)
                        <img src="{{ asset('storage/' . $doctor->user->image) }}" width="100" class="mb-2">
                    @endif
                    <input type="file" name="image" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </section>
</div>
@endsection
