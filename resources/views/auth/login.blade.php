<x-guest-layout>
    <div
        class="flex items-center justify-center min-h-screen px-4 py-12 bg-gradient-to-br from-blue-50 via-white to-purple-50 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <!-- Header Section -->
            <div class="text-center">
                <div
                    class="flex items-center justify-center w-16 h-16 mx-auto rounded-full shadow-lg bg-gradient-to-r from-blue-600 to-purple-600">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <h2 class="mt-6 text-3xl font-bold text-gray-900">
                    Selamat Datang Kembali
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Masuk ke akun Anda untuk mengelola pengeluaran
                </p>
            </div>

            <!-- Login Form Card -->
            <div class="p-8 bg-white border border-gray-100 shadow-xl rounded-2xl">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                        <div class="relative mt-1">
                            <x-text-input id="email"
                                class="block w-full py-3 pl-10 pr-3 transition-colors duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                type="email" name="email" :value="old('email')" required autofocus
                                autocomplete="username" placeholder="Masukkan email Anda" />
                            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                </path>
                            </svg>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                        <div class="relative mt-1">
                            <x-text-input id="password"
                                class="block w-full py-3 pl-10 pr-3 transition-colors duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                type="password" name="password" required autocomplete="current-password"
                                placeholder="Masukkan password Anda" />
                            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="w-4 h-4 text-blue-600 transition-colors duration-200 border-gray-300 rounded shadow-sm focus:ring-blue-500"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-blue-600 transition-colors duration-200 hover:text-blue-800"
                                href="{{ route('password.request') }}">
                                {{ __('Lupa password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <div class="pt-2">
                        <x-primary-button
                            class="w-full flex justify-center items-center py-3 px-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:ring-blue-500 rounded-lg shadow-md transition-all duration-200 transform hover:scale-[1.02]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            {{ __('Masuk') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Register Link -->
                @if (Route::has('register'))
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                                class="font-medium text-blue-600 transition-colors duration-200 hover:text-blue-800">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>
                @endif
            </div>

            <!-- Features Section -->
            <div class="grid grid-cols-1 gap-4 mt-8 sm:grid-cols-3">
                <div class="text-center">
                    <div class="flex items-center justify-center w-10 h-10 mx-auto bg-blue-100 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Dashboard</h3>
                    <p class="text-xs text-gray-500">Pantau keuangan Anda</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center w-10 h-10 mx-auto bg-green-100 rounded-lg">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Pencatatan</h3>
                    <p class="text-xs text-gray-500">Catat pengeluaran mudah</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center w-10 h-10 mx-auto bg-purple-100 rounded-lg">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Kategori</h3>
                    <p class="text-xs text-gray-500">Organisir pengeluaran</p>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-xs text-gray-500">
                    © 2024 Expense Manager. Kelola keuangan dengan mudah.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
