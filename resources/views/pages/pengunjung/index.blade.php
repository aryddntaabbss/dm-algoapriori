@extends('layouts.main')

@section('headerside')
@include('layouts.header')
@include('layouts.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="h2">Daftar Pengunjung</h1>
            <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-header">
                                <a href="{{ route('pengunjung.create') }}" class="btn btn-primary">
                                    <i class="fe fe-file-plus fe-16"></i> Tambah Pengunjung
                                </a>
                                {{-- <a href="/pengunjung" class="btn btn-success text-light">
                                    <i class="fe fe-download fe-16"></i> Download Data Pengunjung
                                </a> --}}
                            </div>
                            <!-- table -->
                            <table class="table datatables" id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th><strong>ID</strong></th>
                                        <th><strong>Nama</strong></th>
                                        <th><strong>No WhatsApp</strong></th>
                                        <th><strong>Jenjang</strong></th>
                                        <th><strong>Kategori</strong></th>
                                        <th><strong>Judul Buku</strong></th>
                                        <th><strong>Tanggal</strong></th>
                                        <th><strong>Aksi</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengunjungs as $pengunjung)
                                    <tr>
                                        <td>{{ $pengunjung->id }}</td>
                                        <td>{{ $pengunjung->nama }}</td>
                                        <td>{{ $pengunjung->no_whatsapp }}</td>
                                        <td>{{ $pengunjung->jenjang }}</td>
                                        <td>{{ $pengunjung->kategori }}</td>
                                        <td>{{ $pengunjung->judul_buku }}</td>
                                        <td>{{ $pengunjung->tanggal }}</td>
                                        <td>
                                            <button class="btn btn-sm dropdown-toggle more-horizontal" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('pengunjung.edit', $pengunjung->id) }}"
                                                    class="btn btn-primary dropdown-item">
                                                    <i class="fe fe-edit"></i> Edit
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <form method="POST"
                                                    action="{{ route('pengunjung.destroy', $pengunjung->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger dropdown-item"
                                                        onclick="return confirm('Anda yakin ingin menghapus pengunjung ini secara permanen?');">
                                                        <i class="fe fe-trash-2"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- simple table -->
            </div> <!-- end section -->
        </div> <!-- .col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable-1').DataTable(); // Inisialisasi DataTables
    });
</script>
@endsection