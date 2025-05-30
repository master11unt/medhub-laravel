@extends('layouts.app')

@section('title', 'Create Obat')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Obat</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Obat</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Obat</h2>
                <p class="section-lead">WYSIWYG editor and code editor.</p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Full Summernote</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('store.obat') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="name">Nama Obat</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="price">Harga</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="number" class="form-control" name="price" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="description">Deskripsi</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="description" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="composition">Komposisi</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="composition" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="packaging">Kemasan</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="packaging" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="benefits">Manfaat</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="benefits" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="category">Kategori</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="category" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="dose">Dosis</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="dose" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="presentation">Penyajian</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="presentation" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="storage">Cara Penyimpanan</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="storage" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="attention">Perhatian</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="attention" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="side_effects">Efek Samping</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="side_effects" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="mims_standard_name">Nama Standar MIMS</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="mims_standard_name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="registration_number">Nomor Izin Edar</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="registration_number" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="drug_class">Golongan Obat</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="drug_class" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="remarks">Keterangan</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="remarks"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="reference">Referensi</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="reference" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="is_prescription">Obat Keras?</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control" name="is_prescription">
                                                <option value="0">Tidak</option>
                                                <option value="1">Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="image">Gambar</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="share_link">Link Share</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="share_link">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="k24_url">URL K24</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="k24_url">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <div class="col-sm-12 col-md-7 offset-md-3">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
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
    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('library/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
