@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Nama</label>
                        <input id="name"
                            type="text"
                            class="form-control"
                            name="name" required
                            autofocus>
                    </div>
                    <div class="form-group col-6">
                        <label for="phone">No. Telpon</label>
                        <input id="phone"
                            type="text"
                            class="form-control"
                            name="phone" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email"
                        type="email"
                        class="form-control"
                        name="email" required>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="password"
                            class="d-block">Password</label>
                        <input id="password"
                            type="password"
                            class="form-control pwstrength"
                            data-indicator="pwindicator"
                            name="password">
                        <div id="pwindicator"
                            class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="password_confirmation"
                            class="d-block">Konfirmasi Password</label>
                        <input id="password_confirmation"
                            type="password"
                            class="form-control"
                            name="password_confirmation">
                    </div>
                </div>

                <!-- <div class="form-divider">
                    Your Data
                </div> -->
                <div class="row">
                    <div class="form-group col-6">
                        <label for="role">Role</label>
                        <select name="role" class="form-control selectric">
                            <option value="admin">Admin</option>
                            <option value="dokter">Dokter</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control selectric">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="no_ktp">No. KTP</label>
                    <input id="no_ktp" type="text"
                        class="form-control" name="no_ktp">
                </div>
                <!-- <div class="form-group">
                    <label>Foto</label>
                    <input type="file"
                        class="form-control" name="image">
                </div> -->

                <!-- <div class="form-group">     
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox"
                            name="agree"
                            class="custom-control-input"
                            id="agree">
                        <label class="custom-control-label"
                            for="agree">I agree with the terms and conditions</label>
                    </div>
                </div> -->

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block">
                        Register
                    </button>
                </div>
            </form>
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
