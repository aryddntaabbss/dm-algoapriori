@extends('layouts.main')

@section('headerside')
@include('layouts.header')
@include('layouts.adminsidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="h2">Edit User</h1>
            <div class="row my-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <!-- Form Edit User -->
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Nama -->
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Role -->
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select id="role" name="role"
                                        class="form-control @error('role') is-invalid @enderror" required>
                                        <option value="admin"
                                            {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="pengunjung"
                                            {{ old('role', $user->role) === 'pengunjung' ? 'selected' : '' }}>Pengunjung
                                        </option>
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password">Password Baru</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Konfirmasi Password -->
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control">
                                </div>

                                <!-- Tombol Submit -->
                                <button type="submit" class="btn btn-primary">
                                    <i class="fe fe-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                    <i class="fe fe-arrow-left"></i> Kembali
                                </a>
                            </form>

                            <!-- Noted -->
                            <div class="mt-4 p-3 bg-gray-100 border border-gray-300 rounded-md">
                                <p class="text-sm text-gray-700 font-semibold">* Catatan :</p>
                                <ul class="text-xs text-gray-600 list-disc pl-5">
                                    <li>Pastikan semua kolom diisi dengan benar sebelum menyimpan perubahan.</li>
                                    <li>Email harus valid dan unik, tidak boleh sama dengan email pengguna lain.</li>
                                    <li>Jika tidak ingin mengubah password, biarkan kolom password kosong.</li>
                                    <li>Jika ingin mengubah password, pastikan password baru diisi dan dikonfirmasi
                                        dengan benar.</li>
                                    <li>Role menentukan hak akses pengguna, pilih sesuai kebutuhan.</li>
                                    <li>Periksa kembali data sebelum menyimpan untuk menghindari kesalahan.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection