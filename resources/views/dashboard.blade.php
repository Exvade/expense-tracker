<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                </path>
            </svg>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="p-6 overflow-hidden text-gray-900 bg-white border border-gray-100 shadow-xl sm:p-8 sm:rounded-xl">

                <!-- Welcome Section -->
                <div class="mb-8 text-center">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 mb-4 rounded-full bg-gradient-to-r from-blue-100 to-blue-200">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h1 class="mb-2 text-2xl font-bold text-gray-900">Selamat Datang di Dashboard</h1>
                    <p class="text-gray-600">Pantau pengeluaran dan kelola keuangan Anda dengan mudah</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Kartu Saldo Awal -->
                    <div
                        class="relative overflow-hidden transition-shadow duration-300 border border-blue-200 shadow-lg bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl hover:shadow-xl">
                        <div class="absolute top-0 right-0 w-20 h-20 -mt-10 -mr-10 bg-blue-200 rounded-full opacity-50">
                        </div>
                        <div class="relative p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-blue-200 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-blue-800">{{ __('Saldo Awal Bulan Ini') }}</h3>
                            <p class="text-3xl font-bold text-blue-900">
                                {{ 'Rp ' . number_format($initialBalance, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Kartu Total Pengeluaran Bulan Ini -->
                    <div
                        class="relative overflow-hidden transition-shadow duration-300 border border-red-200 shadow-lg bg-gradient-to-br from-red-50 to-red-100 rounded-xl hover:shadow-xl">
                        <div class="absolute top-0 right-0 w-20 h-20 -mt-10 -mr-10 bg-red-200 rounded-full opacity-50">
                        </div>
                        <div class="relative p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-red-200 rounded-lg">
                                    <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-red-800">{{ __('Total Pengeluaran Bulan Ini') }}
                            </h3>
                            <p class="text-3xl font-bold text-red-900">
                                {{ 'Rp ' . number_format($totalExpensesThisMonth, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Kartu Sisa Saldo Bulan Ini -->
                    <div
                        class="relative overflow-hidden transition-shadow duration-300 border border-green-200 shadow-lg bg-gradient-to-br from-green-50 to-green-100 rounded-xl hover:shadow-xl">
                        <div
                            class="absolute top-0 right-0 w-20 h-20 -mt-10 -mr-10 bg-green-200 rounded-full opacity-50">
                        </div>
                        <div class="relative p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-green-200 rounded-lg">
                                    <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-green-800">{{ __('Sisa Saldo Bulan Ini') }}</h3>
                            <p class="text-3xl font-bold text-green-900">
                                {{ 'Rp ' . number_format($remainingBalance, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- NEW: Total Pengeluaran Keseluruhan & Sisa Saldo Keseluruhan -->
                <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
                    <!-- Kartu Total Pengeluaran Keseluruhan -->
                    <div
                        class="relative overflow-hidden transition-shadow duration-300 border border-purple-200 shadow-lg bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl hover:shadow-xl">
                        <div
                            class="absolute top-0 right-0 w-20 h-20 -mt-10 -mr-10 bg-purple-200 rounded-full opacity-50">
                        </div>
                        <div class="relative p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-purple-200 rounded-lg">
                                    <svg class="w-6 h-6 text-purple-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-purple-800">
                                {{ __('Total Pengeluaran Keseluruhan') }}
                            </h3>
                            <p class="text-3xl font-bold text-purple-900">
                                {{ 'Rp ' . number_format($totalExpensesAllTime, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Kartu Sisa Saldo Keseluruhan -->
                    <div
                        class="relative overflow-hidden transition-shadow duration-300 border border-indigo-200 shadow-lg bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl hover:shadow-xl">
                        <div
                            class="absolute top-0 right-0 w-20 h-20 -mt-10 -mr-10 bg-indigo-200 rounded-full opacity-50">
                        </div>
                        <div class="relative p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-indigo-200 rounded-lg">
                                    <svg class="w-6 h-6 text-indigo-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.279A8.958 8.958 0 0112 2c-5.072 0-9.182 4.098-9.182 9.167 0 3.25 1.632 6.13 4.103 7.822L12 22l4.479-2.811c2.471-1.692 4.103-4.572 4.103-7.822C21.182 6.098 17.072 2 12 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-indigo-800">{{ __('Sisa Saldo Keseluruhan') }}
                            </h3>
                            <p class="text-3xl font-bold text-indigo-900">
                                {{ 'Rp ' . number_format($remainingBalanceAllTime, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section (existing, no changes) -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Ringkasan Pengeluaran Tahunan -->
                    <div
                        class="relative overflow-hidden transition-shadow duration-300 border border-yellow-200 shadow-lg bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl hover:shadow-xl">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 -mt-12 -mr-12 bg-yellow-200 rounded-full opacity-30">
                        </div>
                        <div class="relative p-6">
                            <div class="flex items-center mb-4">
                                <div class="p-3 mr-4 bg-yellow-200 rounded-lg">
                                    <svg class="w-6 h-6 text-yellow-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-yellow-800">
                                    {{ __('Total Pengeluaran Tahun Ini') }}</h3>
                            </div>
                            <p class="mb-3 text-2xl font-bold text-yellow-900">
                                {{ 'Rp ' . number_format($totalExpensesThisYear, 2, ',', '.') }}
                            </p>
                            <p class="p-3 text-sm text-yellow-700 bg-yellow-200 bg-opacity-50 rounded-lg">
                                <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Ringkasan pengeluaran Anda dari Januari hingga bulan ini.
                            </p>
                        </div>
                    </div>

                    <!-- Pengeluaran Berdasarkan Kategori (Bulan Ini) -->
                    <div
                        class="transition-shadow duration-300 bg-white border border-gray-200 shadow-lg rounded-xl hover:shadow-xl">
                        <div
                            class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 rounded-t-xl">
                            <div class="flex items-center">
                                <div class="p-2 mr-3 bg-gray-200 rounded-lg">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ __('Pengeluaran Berdasarkan Kategori (Bulan Ini)') }}
                                </h3>
                            </div>
                        </div>

                        <div class="p-6">
                            @if ($categoriesWithBudgets->isEmpty())
                                <div class="py-8 text-center">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                    <p class="font-medium text-gray-600">Belum ada kategori atau pengeluaran dicatat
                                        bulan ini.</p>
                                    <p class="mt-1 text-sm text-gray-500">Mulai tambahkan kategori dan pengeluaran
                                        untuk melihat
                                        statistik.</p>
                                </div>
                            @else
                                <div class="space-y-6">
                                    @foreach ($categoriesWithBudgets as $category)
                                        <div
                                            class="p-4 transition-colors duration-200 rounded-lg bg-gray-50 hover:bg-gray-100">
                                            <div class="flex items-center justify-between mb-2">
                                                <div class="flex items-center">
                                                    <div class="w-3 h-3 mr-3 bg-blue-500 rounded-full"></div>
                                                    <p class="font-medium text-gray-800">{{ $category->name }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-semibold text-gray-900">
                                                        {{ 'Rp ' . number_format($category->current_month_spend, 2, ',', '.') }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        Budget:
                                                        {{ 'Rp ' . number_format($category->max_budget, 2, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                            @php
                                                $percentage = $category->percentage_used;
                                                $statusClass = 'text-green-600';
                                                $statusBarClass = 'bg-green-500';
                                                if ($percentage >= 100) {
                                                    $statusClass = 'text-red-600 font-bold';
                                                    $statusBarClass = 'bg-red-500';
                                                } elseif ($percentage >= 75) {
                                                    $statusClass = 'text-orange-600 font-bold';
                                                    $statusBarClass = 'bg-orange-500';
                                                }
                                            @endphp
                                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                                <div class="{{ $statusBarClass }} h-2.5 rounded-full"
                                                    style="width: {{ min(100, $percentage) }}%"></div>
                                            </div>
                                            <p class="text-xs {{ $statusClass }} mt-1">
                                                {{ $percentage }}% digunakan
                                                @if ($percentage >= 100)
                                                    (Melebihi budget!)
                                                @elseif ($percentage >= 75)
                                                    (Mendekati batas budget!)
                                                @endif
                                            </p>
                                            <div class="mt-2 text-sm">
                                                @php
                                                    $remainingBudgetClass = 'text-gray-700';
                                                    if ($category->remaining_budget < 0) {
                                                        $remainingBudgetClass = 'text-red-600 font-bold';
                                                    } elseif (
                                                        $category->remaining_budget < $category->max_budget * 0.25 &&
                                                        $category->max_budget > 0
                                                    ) {
                                                        $remainingBudgetClass = 'text-orange-600 font-bold';
                                                    }
                                                @endphp
                                                <p class="{{ $remainingBudgetClass }}">
                                                    Sisa Budget:
                                                    {{ 'Rp ' . number_format($category->remaining_budget, 2, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Footer Info -->
                <div class="pt-6 mt-8 border-t border-gray-200">
                    <div class="flex items-center justify-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p>Data terakhir diperbarui: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
