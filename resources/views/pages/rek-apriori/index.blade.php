@extends('layouts.main')

@section('headerside')
@include('layouts.header')
@include('layouts.sidebar')
@endsection

@section('content')
<div class="row">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="h2">Proses Rekomendasi Buku Menggunakan Apriori</h1>
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- Form untuk input support dan confidence -->
                                <div class="container">
                                    <form action="{{ route('rek-apriori.process') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary mb-3">Proses Rekomendasi</button>
                                        <div class="form-group">
                                            <label for="min_support">Minimum Support</label>
                                            <input type="number" id="min_support" name="min_support"
                                                class="form-control" step="0.01" placeholder="0.3" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="min_confidence">Minimum Confidence</label>
                                            <input type="number" id="min_confidence" name="min_confidence"
                                                class="form-control" step="0.01" placeholder="0.5" required>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- simple table -->

                <h1 class="h2">Hasil Rekomendasi Buku Menggunakan Apriori</h1>
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- Tabel hasil rekomendasi akan ditampilkan setelah proses -->
                                @if(!empty($aprioriResult))
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><strong>ID Peminjam</strong></th>
                                            <th><strong>Jenjang Peminjam</strong></th>
                                            <th><strong>Kategori Buku</strong></th>
                                            <th><strong>Support</strong></th>
                                            <th><strong>Confidence</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transactions as $key => $transaction)
                                        <tr>
                                            <td>{{ $transaction->id }}</td> <!-- Menampilkan ID Peminjam -->
                                            <td>{{ $transaction->jenjang }}</td> <!-- Menampilkan Jenjang -->
                                            <td>{{ $transaction->kategori_buku }}</td>
                                            <!-- Menampilkan Kategori Buku -->
                                            <td>{{ $aprioriResult[$key]['support'] ?? 'N/A' }}</td>
                                            <!-- Menampilkan Support -->
                                            <td>{{ $aprioriResult[$key]['confidence'] ?? 'N/A' }}</td>
                                            <!-- Menampilkan Confidence -->
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <p>Belum ada data rekomendasi. Silakan jalankan proses rekomendasi.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> <!-- simple table -->
            </div> <!-- end section -->
        </div> <!-- .col-12 -->
    </div> <!-- .container-fluid -->
</div> <!-- .row -->
@endsection