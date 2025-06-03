
@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Layanan Baru</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('store.layanan') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Nama Layanan</label>
                            <input type="text" name="service_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Tempat Layanan</label>
                            <input type="text" name="service_place" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="service_description" class="form-control" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Syarat dan Ketentuan</label>
                            <textarea name="terms_and_conditions" class="form-control" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Lokasi</label>
                            <select name="location_id" class="form-control" required>
                                <option value="">Pilih Lokasi</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Jam Mulai</label>
                            <input type="time" name="time_start" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Jam Selesai</label>
                            <input type="time" name="time_end" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('index.layanan') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection