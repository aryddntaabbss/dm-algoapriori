@extends('layouts.main')
@section('headerside')
@include('layouts.header')
@include('layouts.sidebar')
@endsection

@section('content')
<h1 class="h2 mb-4">Selamat Datang {{ auth()->user()->name }}</h1>

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
    </div>
</div>
@endsection