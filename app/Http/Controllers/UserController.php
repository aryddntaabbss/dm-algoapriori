<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all(); // Mengambil semua data user
        return view('pages.users.index', compact('users')); // Mengirim data ke tampilan pages.user.index
    }

    /**
     * Menampilkan form untuk membuat pengguna baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.users.tambah'); // Menampilkan form tambah user
    }

    /**
     * Menyimpan pengguna baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nomor_tlp' => ['required', 'string', 'max:15', 'regex:/^[0-9]+$/', 'unique:users,nomor_tlp'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,pengunjung'], // Role bisa admin atau pengunjung
        ]);

        // Menyimpan data user baru ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nomor_tlp' => $request->nomor_tlp,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('pages.users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit pengguna.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user')); // Menampilkan form edit user
    }

    /**
     * Memperbarui pengguna yang ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        // Validasi data yang diterima
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'nomor_tlp' => ['required', 'string', 'max:15', 'regex:/^[0-9]+$/', 'unique:users,nomor_tlp,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,pengunjung'], // Role bisa admin atau pengunjung
        ]);

        // Mengupdate data user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nomor_tlp' => $request->nomor_tlp,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
        ]);

        return redirect()->route('pages.users.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    /**
     * Menghapus pengguna dari database.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete(); // Menghapus user
        return redirect()->route('pages.users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
