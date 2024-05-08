<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h1 class="text-center mb-3">Selamat Kembali di FINDER</h1>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address :')" />
            <x-text-input id="email" class="block mt-1 w-full" placeholder="Ania*******@gmail.com" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Password :')" />

            <x-text-input id="password" class="block mt-1 w-full pr-10"
                            placeholder="Masukkan Password"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

         <!-- Lihat / Sembunyikan Kata Sandi -->
            <div class="absolute right-0 pr-3 flex items-center text-sm leading-5" style="top: 37px">
                <button type="button" id="togglePassword" class="focus:outline-none">
                    <i id="toggleIcon" class="bi bi-eye-slash fs-4"></i>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        {{-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> --}}
    
        <div class="flex items-center justify-end mt-2">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="d-grid gap-2 col-6 mx-auto mt-5">
            {{ __('Masuk') }}
        </x-primary-button>

        <div class="text-center mx-auto mt-2">
            <p> {{ __('Belum memiliki akun?') }}
                <a href="{{ route('register') }}">
                    {{ __('Mendaftar') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
