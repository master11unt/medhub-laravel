@extends('layouts.app')

@section('title', 'Dashboard Obat')

@push('style')
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Obat</h1>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Obat</h4>
                    <div class="card-header-action">
                        <a href="{{ route('create.obat') }}" class="btn btn-primary">
                            + Obat
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        @if(Session::get('Sukses'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('Sukses')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if(Session::get('Delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('Delete')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <table class="table-striped mb-0 table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="min-width: 200px;">Nama Obat</th>
                                    <th>Harga</th>
                                    <!-- <th>Deskripsi</th> -->
                                    <th style="min-width: 300px;">Komposisi</th>
                                    <th style="min-width: 200px;">Kemasan</th>
                                    <!-- <th>Manfaat</th> -->
                                    <th>Kategori</th>
                                    <!-- <th>Dosis</th> -->
                                    <th style="min-width: 250px;">Penyajian</th>
                                    <!-- <th>Cara Penyimpanan</th> -->
                                    <!-- <th>Perhatian</th> -->
                                    <!-- <th>Efek Samping</th> -->
                                    <th style="min-width: 200px;">Nama Standar MIMS</th>
                                    <th>Nomor Izin Edar</th>
                                    <th style="min-width: 150px;">Golongan Obat</th>
                                    <!-- <th>Keterangan</th> -->
                                    <!-- <th>Referensi</th> -->
                                    <th>Obat Keras</th>
                                    <th>Gambar</th>
                                    <!-- <th>Link Share</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($medicines as $medicine)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $medicine->name }}</td>
                                    <td>{{ number_format($medicine->price, 2, ',', '.') }}</td>
                                    <!-- <td>{{ $medicine->description }}</td> -->
                                    <td>{{ $medicine->composition }}</td>
                                    <td>{{ $medicine->packaging }}</td>
                                    <!-- <td>{{ $medicine->benefits }}</td> -->
                                    <td>{{ $medicine->category }}</td>
                                    <!-- <td>{{ $medicine->dose }}</td> -->
                                    <td>{{ $medicine->presentation }}</td>
                                    <!-- <td>{{ $medicine->storage }}</td> -->
                                    <!-- <td>{{ $medicine->attention }}</td> -->
                                    <!-- <td>{{ $medicine->side_effects }}</td> -->
                                    <td>{{ $medicine->mims_standard_name }}</td>
                                    <td>{{ $medicine->registration_number }}</td>
                                    <td>{{ $medicine->drug_class }}</td>
                                    <!-- <td>{{ $medicine->remarks }}</td> -->
                                    <!-- <td>{{ $medicine->reference }}</td> -->
                                    <td>
                                        {{ $medicine->is_prescription ? 'Ya' : 'Tidak' }}
                                    </td>
                                    <td>
                                        @if($medicine->image)
                                            <img src="{{ asset('storage/'.$medicine->image) }}" alt="Gambar Obat" width="50">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <!-- <td>
                                        @if($medicine->share_link)
                                            <a href="{{ $medicine->share_link }}" target="_blank">Link</a>
                                        @else
                                            -
                                        @endif
                                    </td> -->
                                    <td>
                                        <form action="{{ route('delete.obat', $medicine->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-action mb-2 mt-2"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a href="{{ route('edit.obat', $medicine->id) }}" class="btn btn-warning btn-action mb-2"><i class="fas fa-pencil-alt"></i></a>
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

{{-- Modal Tambah Obat --}}
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('create.obat')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Nama Obat</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" class="form-control" name="price" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Komposisi</label>
                        <textarea class="form-control" name="composition" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Kemasan</label>
                        <input type="text" class="form-control" name="packaging" required>
                    </div>
                    <div class="form-group">
                        <label>Manfaat</label>
                        <textarea class="form-control" name="benefits" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" class="form-control" name="category" required>
                    </div>
                    <div class="form-group">
                        <label>Dosis</label>
                        <input type="text" class="form-control" name="dose" required>
                    </div>
                    <div class="form-group">
                        <label>Penyajian</label>
                        <input type="text" class="form-control" name="presentation" required>
                    </div>
                    <div class="form-group">
                        <label>Cara Penyimpanan</label>
                        <input type="text" class="form-control" name="storage" required>
                    </div>
                    <div class="form-group">
                        <label>Perhatian</label>
                        <textarea class="form-control" name="attention" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Efek Samping</label>
                        <textarea class="form-control" name="side_effects" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nama Standar MIMS</label>
                        <input type="text" class="form-control" name="mims_standard_name" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Izin Edar</label>
                        <input type="text" class="form-control" name="registration_number" required>
                    </div>
                    <div class="form-group">
                        <label>Golongan Obat</label>
                        <input type="text" class="form-control" name="drug_class" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="remarks"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Referensi</label>
                        <input type="text" class="form-control" name="reference" required>
                    </div>
                    <div class="form-group">
                        <label>Obat Keras?</label>
                        <select class="form-control" name="is_prescription">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group">
                        <label>Link Share</label>
                        <input type="text" class="form-control" name="share_link">
                    </div>
                    <div class="form-group">
                        <label>URL K24</label>
                        <input type="text" class="form-control" name="k24_url">
                    </div>
                    <div class="form-group">
                        <label>Referensi</label>
                        <input type="text" class="form-control" name="reference">
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
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
<script src="{{ asset('js/page/index-0.js') }}"></script>
<script src="{{ asset('library/prismjs/prism.js') }}"></script>
<script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
@endpush