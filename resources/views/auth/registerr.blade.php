@extends('layouts.auth')

@section('title', 'Register')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="card card-primary">
    <div class="card-header">
        <h4>Register</h4>
    </div>

    <div class="card-body">
        <form method="post" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" required name="name" autofocus>
            </div>
            <div class="form-group">
                <label for="phone">Nomor Telp</label>
                <input id="phone" type="number" class="form-control  @error('phone') is-invalid @enderror" required name="phone" autofocus>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" required name="email">
            </div>

            <div class="form-group">
                <label for="password" class="d-block">Password</label>
                <input id="password" type="password" class="form-control pwstrength @error('password') is-invalid @enderror" required data-indicator="pwindicator" name="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="d-block">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" required name="password_confirmation">
            </div>

            <div class="form-group">
                <label for="tanggal_lahir" class="d-block">Tanggal Lahir</label>
                <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" required name="tanggal_lahir">
            </div>

            <div class="form-group">
                <label for="no_ktp">Nomor KTP</label>
                <input id="no_ktp" type="number" class="form-control  @error('no_ktp') is-invalid @enderror" required name="no_ktp" autofocus>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin" class="d-block">Jenis Kelamin</label>
                <select class="form-control selectric">
                    <option value="">Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            
            <!-- <div class="form-group">
                <label for="jenis_kelamin" class="d-block">Jenis Kelamin</label>
                <select class="form-control selectric">
                    <option value="">Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div> -->

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Register
                </button>
            </div>
        </form>

        <div class="text-muted mt-5 text-center">
            Have an account? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush