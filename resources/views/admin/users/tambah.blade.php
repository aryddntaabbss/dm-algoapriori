@extends('layouts.main')

@section('headerside')
@include('layouts.header')
@include('layouts.adminsidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="h4">Tambah User</h2>
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-semibold text-gray-700">Nama</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required>
                            @error('name')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required>
                            @error('email')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block text-sm font-semibold text-gray-700">Role</label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror"
                                required>
                                <option value="admin">Admin</option>
                                <option value="pengunjung">Pengunjung</option>
                            </select>
                            @error('role')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation"
                                class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary py-2 px-4 rounded">Tambah User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection