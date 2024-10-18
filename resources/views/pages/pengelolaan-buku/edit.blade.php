@extends('layouts.main')

@section('headerside')
@include('layouts.header')
@include('layouts.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="mb-2 h2">Edit Data Buku</h1>
            <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-header">
                                <a href="{{ route('buku') }}" class="btn btn-secondary">
                                    <i class="fe fe-arrow-left"></i> Kembali
                                </a>
                            </div>
                            {{-- form --}}
                            <form action="{{ route('buku.update', $book->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3 mt-3">

                                    <!-- Judul Buku -->
                                    <div class="form-group col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="judul">Judul</label>
                                            <input type="text" id="judul"
                                                class="form-control @error('judul') is-invalid @enderror" name="judul"
                                                value="{{ old('judul', $book->judul) }}" placeholder="Judul Buku"
                                                required>
                                            @error('judul')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div> <!-- judul -->

                                    <!-- Pengarang -->
                                    <div class="form-group col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="pengarang">Pengarang</label>
                                            <input type="text" id="pengarang"
                                                class="form-control @error('pengarang') is-invalid @enderror"
                                                name="pengarang" value="{{ old('pengarang', $book->pengarang) }}"
                                                placeholder="Nama Pengarang" required>
                                            @error('pengarang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div> <!-- pengarang -->

                                    <!-- Stok Buku -->
                                    <div class="form-group col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="stok">Stok</label>
                                            <input type="number" id="stok"
                                                class="form-control @error('stok') is-invalid @enderror" name="stok"
                                                value="{{ old('stok', $book->stok) }}" placeholder="Stok Buku" required>
                                            @error('stok')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div> <!-- stok -->

                                    <!-- Kategori Buku -->
                                    <div class="form-group col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" id="kategori"
                                                class="form-control @error('kategori') is-invalid @enderror"
                                                name="kategori" value="{{ old('kategori', $book->kategori) }}"
                                                placeholder="Kategori Buku" required>
                                            @error('kategori')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div> <!-- Kategori -->

                                    <!-- Tahun Terbit -->
                                    <div class="form-group col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="tahun_terbit">Tahun Terbit</label>
                                            <input type="text" id="tahun_terbit"
                                                class="form-control @error('tahun_terbit') is-invalid @enderror"
                                                name="tahun_terbit"
                                                value="{{ old('tahun_terbit', $book->tahun_terbit) }}"
                                                placeholder="Tahun Terbit" required>
                                            @error('tahun_terbit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div> <!-- tahun-terbit -->
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fe fe-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>

                            </form><!-- End General Form Elements -->
                        </div>
                    </div>
                </div> <!-- simple table -->
            </div> <!-- end section -->
        </div> <!-- .col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
@endsection