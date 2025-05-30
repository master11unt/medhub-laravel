@extends('layouts.app')

@section('title', 'Dashboard Kategori Edukasi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Kategori Edukasi</h1>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Kategori Edukasi</h4>
                    <div class="card-header-action">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                            + Kategori
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <!-- Alert Create -->
                        @if(Session::get('Sukses'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('Sukses') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <!-- End Alert Create -->

                        <!-- Alert Delete -->
                        @if(Session::get('Delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('Delete') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <!-- End Alert Delete -->

                        <table class="table-striped mb-0 table">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No</th>
                                    <th>Nama Kategori</th>
                                    <th>Icon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if($category->icon)
                                            <img src="{{ asset('storage/'.$category->icon) }}" alt="Icon" width="40">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('delete.education-categories') }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $category->id }}">
                                            <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Yakin mau hapus?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                        <!-- Edit button trigger modal -->
                                        <button type="button" class="btn btn-warning btn-action" data-toggle="modal" data-target="#edit{{ $category->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
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

{{-- Modal Tambah --}}
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('create.education-categories') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori Edukasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <input type="file" class="form-control" name="icon">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="edit{{ $category->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('update.education-categories', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori Edukasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <input type="file" class="form-control" name="icon">
                        @if($category->icon)
                            <img src="{{ asset('storage/'.$category->icon) }}" alt="Icon" width="40" class="mt-2">
                        @endif
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Edit -->
@endsection

@push('scripts')
<script src="{{ asset('library/prismjs/prism.js') }}"></script>
<script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
@endpush
