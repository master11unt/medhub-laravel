@extends('layouts.app')

@section('title', 'Dashboard Health Records')

@push('style')
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Health Records</h1>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Health Records</h4>
                    <!-- <div class="card-header-action">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                            + Health Record
                        </button>
                    </div> -->
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
                                    <th>Height</th>
                                    <th>Weight</th>
                                    <th>Blood Type</th>
                                    <th>Age</th>
                                    <th>Allergies</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($healthRecords as $record)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $record->user->name ?? '-' }}</td>
                                    <td>{{ $record->height ?? '-' }}</td>
                                    <td>{{ $record->weight ?? '-' }}</td>
                                    <td>{{ $record->blood_type ?? '-' }}</td>
                                    <td>{{ $record->age ?? '-' }}</td>
                                    <td>{{ $record->allergies ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('delete.health_records') }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $record->id }}">
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

{{-- Modal Tambah Health Record --}}
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Health Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('create.health_records') }}" method="POST" enctype="multipart/form-data">
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
                        <label>Height (cm)</label>
                        <input type="number" name="height" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Weight (kg)</label>
                        <input type="number" name="weight" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Blood Type</label>
                        <input type="text" name="blood_type" class="form-control" maxlength="5">
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" name="age" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Allergies</label>
                        <textarea name="allergies" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Current Medications</label>
                        <textarea name="current_medications" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Current Conditions</label>
                        <textarea name="current_conditions" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Medical Document</label>
                        <input type="file" name="medical_document" class="form-control">
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Health Record</button>
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
