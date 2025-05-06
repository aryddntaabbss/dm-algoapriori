@extends('layouts.main')
@section('headerside')
@include('layouts.header')
@include('layouts.adminsidebar')
@endsection

@section('content')
<div class="card shadow mb-3">
    <div class="card-body rounded-sm bg-blue-300">
        <h1 class="h3">🎉 HALO <span class="text-white">{{ auth()->user()->name }}</span>, SELAMAT DATANG DI
            PERPUSTAKAAN DAERAH KOTA TERNATE 🎉</h1>
    </div>
</div>

<div class="row">
    <div class="container-fluid">
        <div class="row">
            <!-- Menampilkan jumlah buku -->
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <span class="h2 mb-0">{{ $bookCount ?? 0 }}</span> <!-- Menampilkan jumlah buku -->
                                <p class="small text-muted mb-0">Jumlah Buku</p>
                            </div>
                            <div class="col-auto">
                                <span class="fe fe-32 fe-book text-muted mb-0" aria-label="Book Count"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menampilkan jumlah pengunjung -->
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <span class="h2 mb-0">{{ $pengunjungCount ?? 0 }}</span>
                                <!-- Menampilkan jumlah pengunjung -->
                                <p class="small text-muted mb-0">Jumlah Pengunjung</p>
                            </div>
                            <div class="col-auto">
                                <span class="fe fe-32 fe-users text-muted mb-0" aria-label="Pengunjung Count"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel User dan Buku yang Dipinjam -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h1 class="h3 mb-4">Daftar Peminjaman Buku</span>
                </h1>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatables" id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama User</th>
                                        <th>Nomor Telepon</th>
                                        <th>Judul Buku</th>
                                        <th>Kode Buku</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($peminjaman as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nomor_tlp }}</td>
                                        <td>{{ $item->judul_buku }}</td>
                                        <td>{{ $item->kode_buku }}</td>
                                        <td>{{ $item->tanggal_peminjaman }}</td>
                                        <td>
                                            @if($item->kategori === 'Pinjam' &&
                                            now()->greaterThan(\Carbon\Carbon::parse($item->tanggal_pengembalian)))
                                            <span class="text-red-600">Terlambat</span>
                                            @elseif($item->kategori === 'Pinjam')
                                            <span class="text-blue-600">Dipinjam</span>
                                            @else
                                            <span class="text-green-600">Dikembalikan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data peminjaman</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('#dataTable-1').DataTable(); // Inisialisasi DataTables
    });
</script>
@endsection