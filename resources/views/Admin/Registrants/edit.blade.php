@extends('layouts.app')

@section('title', 'Edit Data Pendaftar')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Pendaftar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Pendaftar</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Pendaftar</h2>
            <p class="section-lead">Edit informasi pendaftar di sini.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h4>Edit Data Pendaftar</h4></div>
                        <div class="card-body">
                            <form action="{{ route('update.pendaftar', $registrant->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                @php
                                    $colLabel = 'col-form-label text-md-right col-12 col-md-3 col-lg-3';
                                    $colInput = 'col-sm-12 col-md-7';
                                @endphp

                                <div class="form-group row mb-4">
                                    <label class="{{ $colLabel }}">Nama Lengkap</label>
                                    <div class="{{ $colInput }}">
                                        <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $registrant->full_name) }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="{{ $colLabel }}">Tanggal Lahir</label>
                                    <div class="{{ $colInput }}">
                                        <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $registrant->birth_date) }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="{{ $colLabel }}">Jenis Kelamin</label>
                                    <div class="{{ $colInput }}">
                                        <select name="gender" class="form-control" required>
                                            <option value="Laki-Laki" {{ old('gender', $registrant->gender) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                            <option value="Perempuan" {{ old('gender', $registrant->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="{{ $colLabel }}">Alamat</label>
                                    <div class="{{ $colInput }}">
                                        <textarea name="address" class="form-control" required>{{ old('address', $registrant->address) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="{{ $colLabel }}">Nomor HP</label>
                                    <div class="{{ $colInput }}">
                                        <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $registrant->phone_number) }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="{{ $colLabel }}">Nomor Identitas</label>
                                    <div class="{{ $colInput }}">
                                        <input type="text" name="identity_number" class="form-control" value="{{ old('identity_number', $registrant->identity_number) }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="{{ $colLabel }}">Apakah memiliki riwayat penyakit tertentu?</label>
                                    <div class="{{ $colInput }}">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="has_medical_history" value="Ya" 
                                                {{ old('has_medical_history', $registrant->has_medical_history) == 'Ya' ? 'checked' : '' }} required>
                                            <label class="form-check-label">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="has_medical_history" value="Tidak" 
                                                {{ old('has_medical_history', $registrant->has_medical_history) == 'Tidak' ? 'checked' : '' }} required>
                                            <label class="form-check-label">Tidak</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="{{ $colLabel }}">Catatan Khusus</label>
                                    <div class="{{ $colInput }}">
                                        <textarea name="special_notes" class="form-control">{{ old('special_notes', $registrant->special_notes) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <div class="{{ $colInput }} offset-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="agreement" value="1" 
                                                {{ old('agreement', $registrant->agreement) ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                Saya menyetujui data saya digunakan untuk keperluan pendaftaran dan layanan kesehatan
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <div class="{{ $colInput }} offset-md-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('index.pendaftar') }}" class="btn btn-secondary">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- card-body -->
                    </div> <!-- card -->
                </div> <!-- col -->
            </div> <!-- row -->
        </div> <!-- section-body -->
    </section>
</div>
@endsection