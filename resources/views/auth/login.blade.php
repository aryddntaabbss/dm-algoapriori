<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Noted -->
        <div class="mt-4 p-3 bg-gray-100 border border-gray-300 rounded-md">
            <p class="text-sm text-gray-700 font-semibold">* Catatan :</p>
            <ul class="text-xs text-gray-600 list-disc pl-5">
                <li>Gunakan email yang valid dan sudah terdaftar, contoh: <i>user@example.com</i></li>
                <li>Pastikan password sesuai dengan yang telah didaftarkan.</li>
                <li>Periksa kembali apakah Caps Lock aktif sebelum memasukkan password.</li>
                <li>Jika lupa password, silakan klik <b>"Lupa Password?"</b> di bawah.</li>
            </ul>
        </div>

        <div class="mt-4">
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">

                <!-- Link Lupa Password -->
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-gray-600 hover:text-gray-900 underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Lupa Password?') }}
                </a>
                @endif

                <!-- Tombol Register & Login -->
                <div class="flex items-center space-x-3">
                    <x-register-button>
                        {{ __('Daftar') }}
                    </x-register-button>

                    <x-primary-button>
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>