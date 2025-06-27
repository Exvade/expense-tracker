<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>

        <!-- Header -->
        <div class="relative z-10 pt-8 pb-4">
            <div class="flex justify-center">
                <a href="/" class="group">
                    <div
                        class="flex items-center p-3 space-x-3 transition-all duration-300 border shadow-lg rounded-2xl bg-white/80 backdrop-blur-sm border-white/20 hover:shadow-xl group-hover:scale-105">
                        <!-- Custom Logo/Icon -->
                        <div
                            class="flex items-center justify-center w-12 h-12 shadow-md bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl">
                            <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="text-left">
                            <h1 class="text-lg font-bold text-gray-900">Expense Manager</h1>
                            <p class="text-xs text-gray-600">Kelola Keuangan Anda</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 flex items-center justify-center px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer -->
        <div class="relative z-10 pb-8 mt-12">
            <div class="text-center">
                <div class="flex justify-center mb-4 space-x-6">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Aman & Terpercaya
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        Data Terenkripsi
                    </div>
                </div>
                <p class="text-xs text-gray-500">
                    © 2024 Expense Manager. Semua hak dilindungi.
                </p>
            </div>
        </div>

        <!-- Floating Elements -->
        <div
            class="absolute w-20 h-20 bg-blue-200 rounded-full top-20 left-10 mix-blend-multiply filter blur-xl opacity-70 animate-blob">
        </div>
        <div
            class="absolute w-20 h-20 bg-purple-200 rounded-full top-40 right-10 mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute w-20 h-20 bg-pink-200 rounded-full bottom-20 left-20 mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
        </div>
    </div>

    <style>
        .bg-grid-pattern {
            background-image:
                linear-gradient(rgba(0, 0, 0, .1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, .1) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</body>

</html>
