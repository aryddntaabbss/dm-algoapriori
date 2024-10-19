@extends('layouts.main')

@section('headerside')
@include('layouts.header')
@include('layouts.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="h2">Data Buku</h1>
            <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-header">
                                <a href="{{ route('buku.create') }}" class="btn btn-primary">
                                    <i class="fe fe-file-plus fe-16"></i> Tambah Data Buku
                                </a>
                                <a href="/buku" class="btn btn-success text-light">
                                    <i class="fe fe-download fe-16"></i> Download Data Buku
                                </a>
                            </div>
                            <!-- table -->
                            <table class="table datatables" id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th><strong>Kode Buku</strong></th>
                                        <th><strong>Judul Buku</strong></th>
                                        <th><strong>Pengarang</strong></th>
                                        <th><strong>Tahun Terbit</strong></th>
                                        <th><strong>kategori_buku</strong></th>
                                        <th><strong>Stok</strong></th>
                                        <th><strong>Status</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $book)
                                    <tr>
                                        <td>{{ $book->kode_buku }}</td>
                                        <td>{{ $book->judul }}</td>
                                        <td>{{ $book->pengarang }}</td>
                                        <td>{{ $book->tahun_terbit }}</td>
                                        <td>{{ $book->kategori_buku }}</td>
                                        <td>{{ $book->stok }}</td>
                                        <td>{{ $book->stok > 0 ? 'Ada' : 'Kosong' }}</td>
                                        <td>
                                            <button class="btn btn-sm dropdown-toggle more-horizontal" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('buku.edit', $book->id) }}"
                                                    class="btn btn-primary dropdown-item">
                                                    <i class="fe fe-edit"></i> Edit
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <form method="POST" action="{{ route('buku.destroy', $book->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger dropdown-item"
                                                        onclick="return confirm('Anda yakin ingin menghapus buku ini secara permanen?');">
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