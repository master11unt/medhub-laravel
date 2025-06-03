
@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Layanan</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('update.layanan', $serviceSchedule->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Nama Layanan</label>
                            <input type="text" name="service_name" class="form-control" value="{{ old('service_name', $serviceSchedule->service_name) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Tempat Layanan</label>
                            <input type="text" name="service_place" class="form-control" value="{{ old('service_place', $serviceSchedule->service_place) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="service_description" class="form-control" rows="4">{{ old('service_description', $serviceSchedule->service_description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Syarat dan Ketentuan</label>
                            <textarea name="terms_and_conditions" class="form-control" rows="4">{{ old('terms_and_conditions', $serviceSchedule->terms_and_conditions) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Lokasi</label>
                            <select name="location_id" class="form-control" required>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" {{ $serviceSchedule->location_id == $loc->id ? 'selected' : '' }}>
                                        {{ $loc->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date', $serviceSchedule->date) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Jam Mulai</label>
                            <input type="time" name="time_start" class="form-control" value="{{ old('time_start', $serviceSchedule->time_start) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Jam Selesai</label>
                            <input type="time" name="time_end" class="form-control" value="{{ old('time_end', $serviceSchedule->time_end) }}" required>
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('index.layanan') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection