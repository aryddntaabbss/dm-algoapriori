@extends('layouts.main')

@section('headerside')
@include('layouts.header')
@include('layouts.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="h2">Rekomendasi Buku Menggunakan Apriori</h1>
            <div class="row my-4">
                <div class="card shadow">
                    <div class="card-body">
                        @if(!empty($aprioriResult))
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID Peminjam</th>
                                    <th>Jenjang Peminjam</th>
                                    <th>Kategori Buku</th>
                                    <th>Support</th>
                                    <th>Confidence</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $key => $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td> <!-- Menampilkan ID Peminjam -->
                                    <td>{{ $transaction->jenjang }}</td> <!-- Menampilkan Jenjang -->
                                    <td>{{ $transaction->kategori_buku }}</td> <!-- Menampilkan Kategori Buku -->
                                    <td>{{ $aprioriResult[$key]['support'] ?? 'N/A' }}</td>
                                    <!-- Menampilkan Support -->
                                    <td>{{ $aprioriResult[$key]['confidence'] ?? 'N/A' }}</td>
                                    <!-- Menampilkan Confidence -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>Tidak ada data peminjam yang ditemukan.</p>
                        @endif
                    </div>
                </div>
            </div> <!-- simple table -->
        </div> <!-- end section -->
    </div> <!-- .col-12 -->
</div> <!-- .row -->
</div> <!-- .container-fluid -->
@endsection