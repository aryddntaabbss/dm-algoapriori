@extends('layouts.main')

@section('headerside')
@include('layouts.header')
@include('layouts.sidebar')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="h2">Pinjam Buku</h1>
            <div class="row my-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{ route('pengunjung.store') }}" method="POST">
                                @csrf

                                <!-- Nama (Otomatis dari User yang Login) -->
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" id="nama" class="form-control" name="nama"
                                        value="{{ Auth::user()->name }}" readonly>
                                </div>

                                <!-- No Telepon (Otomatis dari User yang Login) -->
                                <div class="form-group">
                                    <label for="nomor_tlp">No Telepon</label>
                                    <input type="text" id="nomor_tlp" class="form-control" name="nomor_tlp"
                                        value="{{ Auth::user()->nomor_tlp }}" readonly>
                                </div>

                                <!-- Jenjang -->
                                <div class="form-group">
                                    <label for="jenjang">Jenjang</label>
                                    <select id="jenjang" class="form-control @error('jenjang') is-invalid @enderror"
                                        name="jenjang" required>
                                        <option value="" disabled selected>Pilih Jenjang</option>
                                        <option value="Siswa">Siswa</option>
                                        <option value="Mahasiswa">Mahasiswa</option>
                                        <option value="Guru">Guru</option>
                                        <option value="Lansia">Lansia</option>
                                    </select>
                                    @error('jenjang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Judul Buku -->
                                <div class="form-group">
                                    <label for="judul_buku">Judul Buku</label>
                                    <select id="judul_buku"
                                        class="form-control @error('judul_buku') is-invalid @enderror" name="judul_buku"
                                        required>
                                        <option value="" disabled selected>Pilih Buku</option>
                                        @foreach($books as $book)
                                        <option value="{{ $book->judul }}">{{ $book->judul }}</option>
                                        @endforeach
                                    </select>
                                    @error('judul_buku')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Cek apakah user sedang meminjam buku ini -->
                                @if(in_array(auth()->user()->role, ['admin', 'pengunjung']))
                                @php
                                // Cek apakah user sedang meminjam buku ini
                                $peminjamanUser = $peminjaman->where('user_id', auth()->user()->id)
                                ->where('judul_buku', $book->judul)
                                ->first();
                                $sedangMeminjam = $peminjamanUser ? true : false;
                                @endphp

                                <button class="btn btn-sm dropdown-toggle more-horizontal" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted sr-only">Action</span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    @if(!$sedangMeminjam)
                                    <!-- Jika buku belum dipinjam, tampilkan tombol Pinjam -->
                                    <form action="{{ route('pengunjung.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="nama" value="{{ auth()->user()->name }}">
                                        <input type="hidden" name="nomor_tlp" value="{{ auth()->user()->nomor_tlp }}">
                                        <input type="hidden" name="judul_buku" value="{{ $book->judul }}">
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="tanggal_peminjaman"
                                            value="{{ now()->toDateString() }}">
                                        <input type="hidden" name="kategori" value="Pinjam">
                                        <button type="submit" class="btn btn-primary dropdown-item">
                                            <i class="fe fe-edit"></i> Pinjam
                                        </button>
                                    </form>
                                    @else
                                    <!-- Jika buku sudah dipinjam, tampilkan tombol Kembalikan -->
                                    <a href="{{ route('pengunjung.edit', ['id' => $peminjamanUser->id]) }}"
                                        class="btn btn-danger dropdown-item">
                                        <i class="fe fe-arrow-left"></i> Kembalikan
                                    </a>
                                    @endif
                                </div>
                                @endif

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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btnPinjam = document.getElementById("btn-pinjam");
        const btnKembalikan = document.getElementById("btn-kembalikan");
        const kategoriInput = document.getElementById("kategori");

        function setActiveButton(selectedButton, value) {
            // Reset style kedua tombol
            btnPinjam.classList.remove("btn-primary", "btn-outline-primary");
            btnPinjam.classList.add(value === "Pinjam" ? "btn-primary" : "btn-outline-primary");

            btnKembalikan.classList.remove("btn-danger", "btn-outline-danger");
            btnKembalikan.classList.add(value === "Kembalikan" ? "btn-danger" : "btn-outline-danger");

            // Set input hidden
            kategoriInput.value = value;
        }

        btnPinjam.addEventListener("click", function() {
            setActiveButton(btnPinjam, "Pinjam");
        });

        btnKembalikan.addEventListener("click", function() {
            setActiveButton(btnKembalikan, "Kembalikan");
        });
    });
</script>
@endsection