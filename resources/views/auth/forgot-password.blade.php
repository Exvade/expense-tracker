<x-guest-layout>
    <!-- Header Section -->
    <div class="mb-8 text-center">
        <div
            class="flex items-center justify-center w-16 h-16 mx-auto rounded-full shadow-lg bg-gradient-to-r from-yellow-600 to-orange-600">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-11.83 1M9 7a2 2 0 012-2m0 0a2 2 0 012 2m-6 0a6 6 0 1011.83 1M9 7h6m-6 0l-1.5 3.5a2.5 2.5 0 105 0L15 7m-6 0l1.5 3.5a2.5 2.5 0 105 0L15 7">
                </path>
            </svg>
        </div>
        <h2 class="mt-6 text-3xl font-bold text-gray-900">
            Lupa Password?
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Jangan khawatir, kami akan membantu Anda
        </p>
    </div>

    <!-- Reset Password Form Card -->
    <div class="p-8 bg-white border border-gray-100 shadow-xl rounded-2xl">
        <!-- Information Section -->
        <div class="p-4 mb-6 border border-blue-200 rounded-lg bg-blue-50">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="text-sm text-blue-800">
                    {{ __('Lupa password Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan reset password yang memungkinkan Anda memilih yang baru.') }}
                </div>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                <div class="relative mt-1">
                    <x-text-input id="email"
                        class="block w-full py-3 pl-10 pr-3 transition-colors duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        type="email" name="email" :value="old('email')" required autofocus
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

            <!-- Reset Button -->
            <div class="pt-2">
                <x-primary-button
                    class="w-full flex justify-center items-center py-3 px-4 bg-gradient-to-r from-yellow-600 to-orange-600 hover:from-yellow-700 hover:to-orange-700 focus:ring-yellow-500 rounded-lg shadow-md transition-all duration-200 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    {{ __('Kirim Link Reset Password') }}
                </x-primary-button>
            </div>

            <!-- Back to Login Link -->
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Ingat password Anda?
                    <a href="{{ route('login') }}"
                        class="font-medium text-yellow-600 transition-colors duration-200 hover:text-yellow-800">
                        Kembali ke login
                    </a>
                </p>
            </div>
        </form>
    </div>

    <!-- Help Section -->
    <div class="grid grid-cols-1 gap-4 mt-8 sm:grid-cols-2">
        <div class="p-4 border shadow-sm bg-white/80 backdrop-blur-sm rounded-xl border-white/20">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-lg">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-gray-900">Aman & Terpercaya</h3>
                    <p class="text-xs text-gray-500">Link reset akan kedaluwarsa dalam 1 jam</p>
                </div>
            </div>
        </div>

        <div class="p-4 border shadow-sm bg-white/80 backdrop-blur-sm rounded-xl border-white/20">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-gray-900">Cek Email Anda</h3>
                    <p class="text-xs text-gray-500">Termasuk folder spam/junk</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Steps Guide -->
    <div class="p-4 mt-6 border border-yellow-200 shadow-sm bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                </path>
            </svg>
            <div>
                <h4 class="mb-2 text-sm font-semibold text-yellow-800">Langkah Selanjutnya</h4>
                <ol class="space-y-1 text-sm text-yellow-700 list-decimal list-inside">
                    <li>Masukkan alamat email yang terdaftar</li>
                    <li>Klik tombol "Kirim Link Reset Password"</li>
                    <li>Cek email Anda (termasuk folder spam)</li>
                    <li>Klik link dalam email untuk reset password</li>
                    <li>Buat password baru yang kuat</li>
                </ol>
            </div>
        </div>
    </div>
</x-guest-layout>
