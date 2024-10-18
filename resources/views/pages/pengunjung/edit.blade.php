@extends('layouts.main')

@section('headerside')
@include('layouts.header')
@include('layouts.sidebar')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="h2">Edit Pengunjung</h1>
            <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-header mb-3">
                                <a href="{{ route('pengunjung') }}" class="btn btn-secondary">
                                    <i class="fe fe-arrow-left"></i> Kembali
                                </a>
                            </div>

                            <form action="{{ route('pengunjung.update', $pengunjung->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Nama -->
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" id="nama"
                                        class="form-control @error('nama') is-invalid @enderror" name="nama"
                                        value="{{ old('nama', $pengunjung->nama) }}" required>
                                    @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- No WhatsApp -->
                                <div class="form-group">
                                    <label for="no_whatsapp">No WhatsApp</label>
                                    <input type="text" id="no_whatsapp"
                                        class="form-control @error('no_whatsapp') is-invalid @enderror"
                                        name="no_whatsapp" value="{{ old('no_whatsapp', $pengunjung->no_whatsapp) }}"
                                        required>
                                    @error('no_whatsapp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Jenjang -->
                                <div class="form-group">
                                    <label for="jenjang">Jenjang</label>
                                    <select id="jenjang" class="form-control @error('jenjang') is-invalid @enderror"
                                        name="jenjang" required>
                                        <option value="Siswa" {{ $pengunjung->jenjang == 'Siswa' ? 'selected' : '' }}>
                                            Siswa</option>
                                        <option value="Mahasiswa"
                                            {{ $pengunjung->jenjang == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa
                                        </option>
                                        <option value="Guru" {{ $pengunjung->jenjang == 'Guru' ? 'selected' : '' }}>Guru
                                        </option>
                                        <option value="Lansia" {{ $pengunjung->jenjang == 'Lansia' ? 'selected' : '' }}>
                                            Lansia</option>
                                    </select>
                                    @error('jenjang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Kategori -->
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select id="kategori" class="form-control @error('kategori') is-invalid @enderror"
                                        name="kategori" required>
                                        <option value="Peminjaman"
                                            {{ $pengunjung->kategori == 'Peminjaman' ? 'selected' : '' }}>Peminjaman
                                        </option>
                                        <option value="Pengembalian"
                                            {{ $pengunjung->kategori == 'Pengembalian' ? 'selected' : '' }}>Pengembalian
                                        </option>
                                    </select>
                                    @error('kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Submit -->
                                <button type="submit" class="btn btn-primary">
                                    <i class="fe fe-save"></i> Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection