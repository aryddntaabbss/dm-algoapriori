@extends('layouts.main')

@section('headerside')
@include('layouts.header')
@include('layouts.adminsidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="h2">Manajemen User</h1>
            <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-header flex justify-between items-center p-4">
                                <!-- Tombol untuk Tambah User -->
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary py-2 px-4 rounded">
                                    <i class="fe fe-user-plus fe-16"></i> Tambah User
                                </a>
                            </div>

                            <!-- Tabel User -->
                            <table class="table datatables" id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th><strong>ID</strong></th>
                                        <th><strong>Nama</strong></th>
                                        <th><strong>Email</strong></th>
                                        <th><strong>Role</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ucfirst($user->role) }}</td>
                                        <td>
                                            <button class="btn btn-sm dropdown-toggle more-horizontal" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="btn btn-primary dropdown-item">
                                                    <i class="fe fe-edit"></i> Edit
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <form method="POST"
                                                    action="{{ route('admin.users.destroy', $user->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger dropdown-item"
                                                        onclick="return confirm('Anda yakin ingin menghapus user ini secara permanen?');">
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
    $(document).ready(function(){
        $('#dataTable-1').DataTable(); // Inisialisasi DataTables
    });
</script>
@endsection