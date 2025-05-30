@extends('layouts.app')

@section('title', 'Dashboard Educations')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">

<style>
    .table {
        min-width: 300px;
    }
    .table th, .table td {
        white-space: nowrap;
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Educations</h1>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Educations</h4>
                    <div class="card-header-action">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                            + Education
                        </button>
                    </div>

                    <!-- Search -->
                    <div class="card-tools pl-3">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <form action="#" method="get">
                                <div class="input-group-append">
                                    <input type="search" name="search" class="form-control float-right"
                                        placeholder="Search">
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
                        @if(Session::get('Sukses'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('Sukses')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <!-- End Alert Create -->

                        <!-- Alert Delete -->
                        @if(Session::get('Delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('Delete')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <!-- End Alert Delete -->

                        <table class="table-striped mb-0 table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <!-- <th>Conten</th> -->
                                    <th>Type</th>
                                    <th>Source</th>
                                    <th>Author</th>
                                    <th>Published At</th>
                                    <th>Thumbnail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($educations as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->title }}</td>
                                    <!-- <td>{{ $row->content }}</td> -->
                                    <td>{{ ucfirst($row->type) }}</td>
                                    <td>{{ $row->source }}</td>
                                    <td>{{ $row->author_name }}</td>
                                    <td>{{ $row->published_at->format('d M Y') }}</td>
                                    <td>
                                        @if($row->thumbnail)
                                            <img src="{{ asset('storage/'.$row->thumbnail) }}" alt="Thumbnail" width="50">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-row gap-1" style="gap: 6px;">
                                            <form action="{{ route('delete.educations', $row->id)}}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                <button type="submit" class="btn btn-danger btn-action" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                            <button type="button" class="btn btn-warning btn-action" data-toggle="modal" data-target="#edit{{ $row->id }}" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-info btn-action" data-toggle="modal" data-target="#show{{ $row->id }}" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
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

@foreach($educations as $row)
<!-- Modal Edit -->
<div class="modal fade" id="edit{{ $row->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('update.educations', $row->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Education</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Isi form mirip form tambah, tapi value diisi dari $row -->
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="title" value="{{ $row->title }}" required>
                    </div>
                    <div class="form-group">
                        <label>Konten (Jika Artikel)</label>
                        <textarea name="content" class="form-control summernote">{{ $row->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Tipe</label>
                        <select name="type" class="form-control" required>
                            <option value="artikel" {{ $row->type == 'artikel' ? 'selected' : '' }}>Artikel</option>
                            <option value="video" {{ $row->type == 'video' ? 'selected' : '' }}>Video</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Thumbnail</label>
                        <input type="file" class="form-control" name="thumbnail" accept="image/*">
                        @if($row->thumbnail)
                            <img src="{{ asset('storage/'.$row->thumbnail) }}" alt="Thumbnail" width="80" class="mt-2">
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Source</label>
                        <input type="text" class="form-control" name="source" value="{{ $row->source }}" required>
                    </div>
                    <div class="form-group">
                        <label>Institution Logo</label>
                        <input type="file" class="form-control" name="institution_logo" accept="image/*">
                        @if($row->institution_logo)
                            <img src="{{ asset('storage/'.$row->institution_logo) }}" alt="Logo" width="80" class="mt-2">
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Author Name</label>
                        <input type="text" class="form-control" name="author_name" value="{{ $row->author_name }}" required>
                    </div>
                    <div class="form-group">
                        <label>Published At</label>
                        <input type="datetime-local" class="form-control" name="published_at" value="{{ \Carbon\Carbon::parse($row->published_at)->format('Y-m-d\TH:i') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Video URL (Jika Video)</label>
                        <input type="url" class="form-control" name="video_url" value="{{ $row->video_url }}">
                    </div>
                    <div class="form-group">
                        <label>Share Link</label>
                        <input type="url" class="form-control" name="share_link" placeholder="https://contoh.com/share-link">
                    </div>
                    <div class="form-group">
                        <label>Kategori Edukasi</label>
                        <select name="education_category_id" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $row->education_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach($educations as $row)
<!-- Modal Show -->
<div class="modal fade" id="show{{ $row->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">{{ $row->title }}</h5>
                @if($row->thumbnail)
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{ asset('storage/'.$row->thumbnail) }}" alt="Thumbnail" width="300" class="mb-3 mx-auto d-block">
                    </div>
                @endif

                @if($row->type == 'artikel')
                    <div class="d-flex align-items-center mb-2" style="gap: 16px;">
                        @if($row->institution_logo)
                            <img src="{{ asset('storage/'.$row->institution_logo) }}" alt="Institution Logo" width="20" style="object-fit:contain; border-radius:8px;">
                        @endif
                        <div>
                            <strong>Source:</strong> {{ $row->source }}
                        </div>
                    </div>
                    <div>
                        <strong>Konten:</strong>
                        <div class="mt-2" style="border:1px #eee solid; border-radius:8px; padding:12px; background:#fafbfc;">
                            {!! $row->content !!}
                        </div>
                    </div>
                @elseif($row->type == 'video')
                    @if($row->video_url)
                        <div class="mb-2">
                            <strong>Video:</strong>
                            <div class="embed-responsive embed-responsive-16by9 mt-2">
                                <iframe class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::afterLast($row->video_url, 'v=') }}"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif
                    @if($row->content)
                        <div>
                            <strong>Konten:</strong>
                            <div class="mt-2" style="border:1px #eee solid; border-radius:8px; padding:12px; background:#fafbfc;">
                                {!! $row->content !!}
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- modal tambah education --}}
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('create.educations') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="form-group">
                        <label>Konten (Jika Artikel)</label>
                        <textarea name="content" class="form-control summernote"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Tipe</label>
                        <select name="type" class="form-control" required>
                            <option value="">Pilih Tipe</option>
                            <option value="artikel">Artikel</option>
                            <option value="video">Video</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Thumbnail</label>
                        <input type="file" class="form-control" name="thumbnail" accept="image/*" onchange="previewThumbnail(event)">
                        <img id="thumbnail-preview" src="#" alt="Thumbnail Preview" style="margin-top: 10px; max-height: 150px; display: none;">
                    </div>

                    <div class="form-group">
                        <label>Source</label>
                        <input type="text" class="form-control" name="source" required>
                    </div>

                    <div class="form-group">
                        <label>Institution Logo</label>
                        <input type="file" class="form-control" name="institution_logo" accept="image/*" onchange="previewLogo(event)">
                        <img id="logo-preview" src="#" alt="Logo Preview" style="margin-top: 10px; max-height: 150px; display: none;">
                    </div>

                    <div class="form-group">
                        <label>Author Name</label>
                        <input type="text" class="form-control" name="author_name" required>
                    </div>

                    <div class="form-group">
                        <label>Published At</label>
                        <input type="datetime-local" class="form-control" name="published_at" required>
                    </div>

                    <div class="form-group">
                        <label>Video URL (Jika Video)</label>
                        <input type="url" class="form-control" name="video_url">
                    </div>

                    <div class="form-group">
                        <label>Share Link</label>
                        <input type="url" class="form-control" name="share_link" placeholder="https://contoh.com/share-link">
                    </div>

                    <div class="form-group">
                        <label>Kategori Edukasi</label>
                        <select name="education_category_id" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>

            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- JS Libraries -->
<script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script src="{{ asset('library/prismjs/prism.js') }}"></script>

<!-- Page Specific JS -->
<script src="{{ asset('js/page/index-0.js') }}"></script>
<script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>

<script>
$(document).ready(function() {
    $('.summernote').summernote({
        height: 200
    });
});
</script>

<!-- Image Preview Script -->
<script>
function previewThumbnail(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('thumbnail-preview');
        output.src = reader.result;
        output.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}

function previewLogo(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('logo-preview');
        output.src = reader.result;
        output.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endpush
