<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="w-full max-w-md mx-auto">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <p class="text-xs text-gray-500 mt-1">* Gunakan nama lengkap sesuai identitas.</p>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <p class="text-xs text-gray-500 mt-1">* Masukkan email yang valid, contoh: <i>user@example.com</i></p>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Nomor Telepon -->
        <div class="mb-4">
            <x-input-label for="nomor_tlp" :value="__('Nomor Telepon')" />
            <x-text-input id="nomor_tlp"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                type="text" name="nomor_tlp" :value="old('nomor_tlp')" required autocomplete="tel" />
            <p class="text-xs text-gray-500 mt-1">* Masukkan nomor telepon yang aktif.</p>
            <x-input-error :messages="$errors->get('nomor_tlp')" class="mt-2" />
        </div>

        <!-- Jenjang -->
        <div class="mb-4">
            <x-input-label for="jenjang" :value="__('Jenjang')" />
            <select id="jenjang" name="jenjang"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required>
                <option value="" disabled selected>Pilih Jenjang</option>
                <option value="Siswa" {{ old('jenjang') == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                <option value="Mahasiswa" {{ old('jenjang') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="Guru" {{ old('jenjang') == 'Guru' ? 'selected' : '' }}>Guru</option>
                <option value="Lansia" {{ old('jenjang') == 'Lansia' ? 'selected' : '' }}>Lansia</option>
            </select>
            <p class="text-xs text-gray-500 mt-1">* Pilih jenjang yang sesuai.</p>
            <x-input-error :messages="$errors->get('jenjang')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                type="password" name="password" required autocomplete="new-password" />
            <p class="text-xs text-gray-500 mt-1">* Password harus minimal 8 karakter, mengandung huruf besar, kecil,
                angka, dan simbol.</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <p class="text-xs text-gray-500 mt-1">* Pastikan password yang dimasukkan sama dengan di atas.</p>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit & Login Link -->
        <div class="flex flex-col sm:flex-row items-center justify-between mt-6">
            <a class="text-sm text-gray-600 hover:text-gray-900 underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                Sudah Punya Akun?
            </a>

            <x-primary-button class="mt-3 sm:mt-0">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>