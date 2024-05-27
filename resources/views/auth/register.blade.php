<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h1 class="text-center mb-3">Gabung FINDER<span class="text-primary">Track</span></h1>
        

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama :')" />
            <x-text-input id="name" class="block mt-1 w-full" placeholder="Masukkan Nama" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email Address :')" />
            <x-text-input id="email" class="block mt-1 w-full" placeholder="Ania*******@gmail.com" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Kelas -->
        <div class="mt-4">
            <x-input-label for="kelas" :value="__('Kelas :')" />
            <x-text-input id="kelas" class="block mt-1 w-full" placeholder="Masukkan Kelas" type="text" name="kelas" :value="old('kelas')" required autocomplete="kelas" />
            <x-input-error :messages="$errors->get('kelas')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Password :')" />

            <x-text-input id="password" class="block mt-1 w-full pr-10"
                            placeholder="Masukkan Password"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <!-- Lihat / Sembunyikan Kata Sandi -->
            <div class="absolute right-0 pr-3 flex items-center text-sm leading-5" style="top: 37px">
                <button type="button" id="togglePassword" class="focus:outline-none">
                    <i id="toggleIcon" class="bi bi-eye-slash fs-4"></i>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 relative">
            <x-input-label for="password_confirmation" :value="__('Confirm Password :')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10"
                            placeholder="Konfirmasi Password"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <!-- Lihat / Sembunyikan Kata Sandi -->
            <div class="absolute right-0 pr-3 flex items-center text-sm leading-5" style="top: 37px">
                <button type="button" id="togglePassword2" class="focus:outline-none">
                    <i id="toggleIcon2" class="bi bi-eye-slash fs-4"></i>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-grid gap-2 col-6 mx-auto mt-5">
            <x-primary-button class="">
                {{ __('Daftar') }}
            </x-primary-button>

            <p class="text center">
                {{ __('Sudah memiliki akun?') }}
                <a href="{{ route('login') }}">
                    {{ __('Masuk') }}
                </a>
            </p>

        </div>
    </form>
</x-guest-layout>
