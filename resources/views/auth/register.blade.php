<x-guest-layout>
    <!-- Header Section -->
    <div class="mb-8 text-center">
        <div
            class="flex items-center justify-center w-16 h-16 mx-auto rounded-full shadow-lg bg-gradient-to-r from-green-600 to-blue-600">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
        </div>
        <h2 class="mt-6 text-3xl font-bold text-gray-900">
            Buat Akun Baru
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Bergabunglah dan mulai kelola keuangan Anda dengan mudah
        </p>
    </div>

    <!-- Register Form Card -->
    <div class="p-8 bg-white border border-gray-100 shadow-xl rounded-2xl">
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" class="text-sm font-medium text-gray-700" />
                <div class="relative mt-1">
                    <x-text-input id="name"
                        class="block w-full py-3 pl-10 pr-3 transition-colors duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                        placeholder="Masukkan nama lengkap Anda" />
                    <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                <div class="relative mt-1">
                    <x-text-input id="email"
                        class="block w-full py-3 pl-10 pr-3 transition-colors duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        type="email" name="email" :value="old('email')" required autocomplete="username"
                        placeholder="Masukkan alamat email Anda" />
                    <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
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
                        class="block w-full py-3 pl-10 pr-3 transition-colors duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        type="password" name="password" required autocomplete="new-password"
                        placeholder="Buat password yang kuat" />
                    <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')"
                    class="text-sm font-medium text-gray-700" />
                <div class="relative mt-1">
                    <x-text-input id="password_confirmation"
                        class="block w-full py-3 pl-10 pr-3 transition-colors duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        type="password" name="password_confirmation" required autocomplete="new-password"
                        placeholder="Ulangi password Anda" />
                    <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Terms and Privacy -->
            <div class="p-4 rounded-lg bg-gray-50">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-sm text-gray-600">
                        <p>Dengan mendaftar, Anda menyetujui <a href="#"
                                class="font-medium text-blue-600 hover:text-blue-800">Syarat & Ketentuan</a> dan <a
                                href="#" class="font-medium text-blue-600 hover:text-blue-800">Kebijakan
                                Privasi</a> kami.</p>
                    </div>
                </div>
            </div>

            <!-- Register Button -->
            <div class="pt-2">
                <x-primary-button
                    class="w-full flex justify-center items-center py-3 px-4 bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 focus:ring-green-500 rounded-lg shadow-md transition-all duration-200 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                        </path>
                    </svg>
                    {{ __('Daftar Sekarang') }}
                </x-primary-button>
            </div>

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                        class="font-medium text-green-600 transition-colors duration-200 hover:text-green-800">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </form>
    </div>

    <!-- Benefits Section -->
    <div class="grid grid-cols-1 gap-4 mt-8 sm:grid-cols-2">
        <div class="p-4 border shadow-sm bg-white/80 backdrop-blur-sm rounded-xl border-white/20">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-lg">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-gray-900">100% Gratis</h3>
                    <p class="text-xs text-gray-500">Tidak ada biaya tersembunyi</p>
                </div>
            </div>
        </div>

        <div class="p-4 border shadow-sm bg-white/80 backdrop-blur-sm rounded-xl border-white/20">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-gray-900">Mudah Digunakan</h3>
                    <p class="text-xs text-gray-500">Interface yang intuitif</p>
                </div>
            </div>
        </div>

        <div class="p-4 border shadow-sm bg-white/80 backdrop-blur-sm rounded-xl border-white/20">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-10 h-10 bg-purple-100 rounded-lg">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-gray-900">Laporan Lengkap</h3>
                    <p class="text-xs text-gray-500">Analisis keuangan detail</p>
                </div>
            </div>
        </div>

        <div class="p-4 border shadow-sm bg-white/80 backdrop-blur-sm rounded-xl border-white/20">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-10 h-10 bg-yellow-100 rounded-lg">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-gray-900">Akses 24/7</h3>
                    <p class="text-xs text-gray-500">Kapan saja, dimana saja</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
