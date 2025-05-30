@extends('layouts.app')

@section('title', 'Dashboard Consultations')

@push('style')
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Consultations</h1>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Consultations</h4>
                    <div class="card-header-action">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                            + Consultation
                        </button>
                    </div>

                    <div class="card-tools pl-3">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <form action="#" method="get">
                                <div class="input-group-append">
                                    <input type="search" name="search" class="form-control float-right" placeholder="Search">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">

                        @if(Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(Session::get('delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('delete') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Doctor</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($consultations as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->user->name ?? '-' }}</td>
                                    <td>{{ $row->doctor->name ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->consultation_date)->format('d-m-Y H:i') }}</td>
                                    <td>{{ ucfirst($row->consultation_type) }}</td>
                                    <td>{{ ucfirst($row->status) }}</td>
                                    <td>
                                        <form action="{{ route('delete.consultations') }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <button type="submit" class="btn btn-danger btn-action">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

{{-- Modal Tambah Consultation --}}
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Consultation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('create.consultations') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>User</label>
                        <select name="user_id" class="form-control" required>
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Doctor</label>
                        <select name="doctor_id" class="form-control" required>
                            <option value="">Pilih Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Consultation Date</label>
                        <input type="datetime-local" name="consultation_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Consultation Type</label>
                        <select name="consultation_type" class="form-control" required>
                            <option value="umum">Umum</option>
                            <option value="spesialis">Spesialis</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Consultation</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script src="{{ asset('library/prismjs/prism.js') }}"></script>
<script src="{{ asset('js/page/index-0.js') }}"></script>
<script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
@endpush
