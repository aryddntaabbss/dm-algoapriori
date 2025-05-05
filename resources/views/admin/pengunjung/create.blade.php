@extends('layouts.main')

@section('headerside')
@include('layouts.header')
@include('layouts.adminsidebar')
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
                            <form action="{{ route('admin.pengunjung.store') }}" method="POST">
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
                                    <input type="text" id="jenjang" class="form-control" name="jenjang"
                                        value="{{ Auth::user()->jenjang }}" readonly>
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