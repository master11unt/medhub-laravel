@extends('layouts.app')

@section('title', 'Lengkapi Data Dokter')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Lengkapi Data Dokter</h1>
        </div>
        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Data Dokter</h4>
                        </div>
                        <form method="POST" action="{{ route('doctor.complete-profile') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Spesialisasi <span class="text-danger">*</span></label>
                                    <input type="text" name="specialization" class="form-control" required value="{{ old('specialization') }}">
                                </div>
                                <div class="form-group">
                                    <label>Pendidikan</label>
                                    <input type="text" name="education" class="form-control" value="{{ old('education') }}">
                                </div>
                                <div class="form-group">
                                    <label>Tempat Praktek</label>
                                    <input type="text" name="practice_place" class="form-control" value="{{ old('practice_place') }}">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nomor STR/SIP <span class="text-danger">*</span></label>
                                    <input type="text" name="license_number" class="form-control" required value="{{ old('license_number') }}">
                                </div>
                                <div class="form-group">
                                    <label>Foto Profil <span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="form-control-file" accept="image/*" required>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection