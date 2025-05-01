@extends('layouts.main')

@section('headerside')
@include('layouts.header')
@include('layouts.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <h1 class="h2 text-center mb-4">Proses Rekomendasi Buku Menggunakan Apriori</h1>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('rek-apriori.process') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Input Minimum Support -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_support"><strong>Minimum Support</strong></label>
                                    <input type="number" id="min_support" name="min_support"
                                        class="form-control @error('min_support') is-invalid @enderror" step="0.01"
                                        value="{{ old('min_support', 0.3) }}" required
                                        placeholder="Masukkan nilai antara 0 - 1 (contoh: 0.3)">
                                    <small class="text-muted">Nilai minimum support antara 0 dan 1.</small>
                                    @error('min_support')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Minimum Confidence -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_confidence"><strong>Minimum Confidence</strong></label>
                                    <input type="number" id="min_confidence" name="min_confidence"
                                        class="form-control @error('min_confidence') is-invalid @enderror" step="0.01"
                                        value="{{ old('min_confidence', 0.5) }}" required
                                        placeholder="Masukkan nilai antara 0 - 1 (contoh: 0.5)">
                                    <small class="text-muted">Nilai minimum confidence antara 0 dan 1.</small>
                                    @error('min_confidence')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 w-100">Proses Rekomendasi</button>
                    </form>
                </div>
            </div>

            <h1 class="h2 text-center mt-5">Hasil Rekomendasi Buku</h1>

            <div class="card shadow">
                <div class="card-body">
                    @if(isset($aprioriResult) && count($aprioriResult) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Itemset Awal</th>
                                    <th>Rekomendasi</th>
                                    <th>Support</th>
                                    <th>Confidence</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aprioriResult as $rule)
                                <tr>
                                    <td>{{ implode(", ", $rule['antecedent'] ?? []) }}</td>
                                    <td>{{ implode(", ", $rule['consequent'] ?? []) }}</td>
                                    <td>{{ number_format($rule['support'] ?? 0, 2) }}</td>
                                    <td>{{ number_format($rule['confidence'] ?? 0, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-center text-muted">Belum ada hasil rekomendasi. Silakan jalankan proses terlebih
                        dahulu.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection