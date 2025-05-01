<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input dari pengguna
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'nomor_tlp' => ['required', 'string', 'max:15', 'regex:/^[0-9]+$/', 'unique:users,nomor_tlp'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'jenjang' => ['required', 'in:Siswa,Mahasiswa,Guru,Lansia'], // Validasi pilihan jenjang
        ]);

        // Buat user baru dengan role 'pengunjung'
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nomor_tlp' => $validated['nomor_tlp'],
            'password' => Hash::make($validated['password']),
            'role' => 'pengunjung',  // Menetapkan role pengunjung
            'jenjang' => $validated['jenjang'], // Simpan jenjang
        ]);

        // Event pendaftaran user baru
        event(new Registered($user));

        // Otomatis login setelah registrasi
        Auth::login($user);

        // Redirect ke dashboard
        return redirect()->route('dashboard');
    }
}
