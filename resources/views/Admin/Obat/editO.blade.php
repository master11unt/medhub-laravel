@extends('layouts.app')

@section('title', 'Edit Obat')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('library/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Obat</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Obat</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Obat</h2>
                <p class="section-lead">Edit data obat di sini.</p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Obat</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('update.obat', $medicine->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Obat</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $medicine->name) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="number" class="form-control" name="price" value="{{ old('price', $medicine->price) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="description" required>{{ old('description', $medicine->description) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Komposisi</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="composition" required>{{ old('composition', $medicine->composition) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kemasan</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="packaging" value="{{ old('packaging', $medicine->packaging) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Manfaat</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="benefits" required>{{ old('benefits', $medicine->benefits) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="category" value="{{ old('category', $medicine->category) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Dosis</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="dose" value="{{ old('dose', $medicine->dose) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penyajian</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="presentation" value="{{ old('presentation', $medicine->presentation) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Cara Penyimpanan</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="storage" value="{{ old('storage', $medicine->storage) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Perhatian</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="attention" required>{{ old('attention', $medicine->attention) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Efek Samping</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="side_effects" required>{{ old('side_effects', $medicine->side_effects) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Standar MIMS</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="mims_standard_name" value="{{ old('mims_standard_name', $medicine->mims_standard_name) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Izin Edar</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="registration_number" value="{{ old('registration_number', $medicine->registration_number) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Golongan Obat</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="drug_class" value="{{ old('drug_class', $medicine->drug_class) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="remarks">{{ old('remarks', $medicine->remarks) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Referensi</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control summernote" name="reference" required>{{ old('reference', $medicine->reference) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Obat Keras?</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control" name="is_prescription">
                                                <option value="0" {{ old('is_prescription', $medicine->is_prescription) == 0 ? 'selected' : '' }}>Tidak</option>
                                                <option value="1" {{ old('is_prescription', $medicine->is_prescription) == 1 ? 'selected' : '' }}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar</label>
                                        <div class="col-sm-12 col-md-7">
                                            @if($medicine->image)
                                                <img src="{{ asset('storage/'.$medicine->image) }}" alt="Gambar Obat" width="80" class="mb-2"><br>
                                            @endif
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Link Share</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="share_link" value="{{ old('share_link', $medicine->share_link) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">URL K24</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="k24_url" value="{{ old('k24_url', $medicine->k24_url) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <div class="col-sm-12 col-md-7 offset-md-3">
                                            <button class="btn btn-primary" type="submit">Update</button>
                                            <a href="{{ route('index.obat') }}" class="btn btn-secondary">Batal</a>
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

@push('scripts')
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@endpush