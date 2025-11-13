<x-guest-layout>

    <div class="min-h-screen flex flex-col lg:flex-row">

        <div class="lg:w-1/2 w-full flex flex-col justify-center items-center p-6 sm:p-12 bg-gray-100">

            <div class="w-full sm:max-w-md mt-6">

                <div class="w-full text-right mb-4 block lg:hidden">
                    <a href="{{ url('/') }}" class="text-sm text-gray-600 hover:text-primary hover:underline">
                        Kembali ke Homepage →
                    </a>
                </div>
                <h2 class="text-3xl font-bold text-gray-900">
                    Selamat Datang
                </h2>
                <h2 class="text-3xl font-bold text-gray-900">
                    Kembali di Gen-Z Psychology
                </h2>
                <p class="mt-2 text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-primary hover:underline">
                        Daftar, yuk!
                    </a>
                </p>

                <div class="mt-6">
                    <a href="{{ route('social.redirect', 'google') }}"
                        class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-5 h-5 me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                            <path fill="#FFC107"
                                d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C12.955 4 4 12.955 4 24s8.955 20 20 20s20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z" />
                            <path fill="#FF3D00"
                                d="m6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C16.318 4 9.656 8.337 6.306 14.691z" />
                            <path fill="#4CAF50"
                                d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238C29.211 35.091 26.715 36 24 36c-5.223 0-9.641-3.134-11.383-7.46l-6.522 5.025C9.505 39.556 16.227 44 24 44z" />
                            <path fill="#1976D2"
                                d="M43.611 20.083H42V20H24v8h11.303c-.792 2.237-2.231 4.166-4.087 5.571l6.19 5.238C42.012 34.421 44 29.561 44 24c0-1.341-.138-2.65-.389-3.917z" />
                        </svg>
                        Masuk dengan Google
                    </a>
                </div>

                <div class="flex items-center my-4">
                    <hr class="flex-grow border-t border-gray-300">
                    <span class="px-3 text-sm text-gray-500">atau masuk dengan email</span>
                    <hr class="flex-grow border-t border-gray-300">
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" class="mb-1" />
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username" placeholder="Masukkan email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" class="mb-1" />
                        <x-text-input id="password" type="password" name="password" required
                            autocomplete="current-password" placeholder="Masukkan password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <p class="text-xs text-gray-500 mt-1">{{ __('Minimal 8 karakter') }}</p>
                    </div>

                    <div class="block">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-gray-800 bg-pink-400 hover:bg-pink-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            {{ __('Masuk') }}
                        </button>

                    </div>

                    <div class="text-center">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                        @endif
                    </div>
                </form>

            </div>
        </div>


        <div class="lg:w-1/2 w-full bg-cover bg-center hidden lg:block" <div
            class="lg:w-1/2 w-full bg-cover bg-center hidden lg:block relative"
            style="background-image: url('{{ asset('images/auth-bg-login.jpg') }}'); background-color: #FBEFEF;">

            <a href="{{ url('/') }}"
                class="absolute top-8 right-8 text-sm text-black font-medium hover:underline">
                Kembali ke Homepage→
            </a>
        </div>
    </div>
</x-guest-layout>
