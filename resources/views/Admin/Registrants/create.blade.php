@extends('layouts.app')

@section('title', 'Form Pendaftaran')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Pendaftaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Pendaftaran</a></div>
                <div class="breadcrumb-item">Form</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Formulir Pendaftaran Pasien</h2>
            <p class="section-lead">Silakan isi data diri Anda secara lengkap.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Diri</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.pendaftar') }}" method="POST">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="full_name" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Lahir</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="date" name="birth_date" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="gender" class="form-control" required>
                                            <option value="">Pilih</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="address" class="form-control" required></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor HP</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="phone_number" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Identitas</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="identity_number" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Catatan Khusus</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="special_notes" class="form-control"></textarea>
                                    </div>
                                </div>

                                {{-- Field baru sesuai migration --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Apakah memiliki riwayat penyakit tertentu?</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="has_medical_history" value="Ya" required>
                                            <label class="form-check-label">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="has_medical_history" value="Tidak" required>
                                            <label class="form-check-label">Tidak</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <div class="col-sm-12 col-md-7 offset-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="agreement" value="1" required>
                                            <label class="form-check-label">
                                                Saya menyetujui data saya digunakan untuk keperluan pendaftaran dan layanan kesehatan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <div class="col-sm-12 col-md-7 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Daftar</button>
                                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection