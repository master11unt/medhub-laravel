@extends('layouts.app')

@section('title', 'Dashboard Prescriptions')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Prescriptions</h1>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Prescriptions</h4>
                    <div class="card-header-action">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                            + Prescription
                        </button>
                    </div>

                    <!-- Search -->
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
                        <!-- Alert Create -->
                        @if(Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <!-- Alert Delete -->
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
                                    <th style="width: 10px;">No</th>
                                    <th>Consultation ID</th>
                                    <th>Medicine Name</th>
                                    <th>Instructions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prescriptions as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->consultation_id }}</td>
                                    <td>{{ $row->medicine_name }}</td>
                                    <td>{{ $row->instructions }}</td>
                                    <td>
                                        <form action="{{ route('delete.prescriptions') }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <button type="submit" class="btn btn-danger btn-action">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        {{-- Tombol Edit (Opsional: nanti bisa pakai modal edit) --}}
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

{{-- Modal Tambah Prescription --}}
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Prescription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('create.prescriptions') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Consultation</label>
                        <select name="consultation_id" class="form-control" required>
                            <option value="">Pilih Consultation</option>
                            @foreach($consultations as $consultation)
                                <option value="{{ $consultation->id }}">#{{ $consultation->id }} - {{ $consultation->user->name ?? 'User' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Medicine Name</label>
                        <input type="text" name="medicine_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Instructions</label>
                        <textarea name="instructions" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Prescription</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- JS Libraies -->
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
