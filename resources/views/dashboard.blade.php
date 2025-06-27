<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden text-gray-900 bg-white shadow-sm sm:rounded-lg">

                <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Kartu Saldo Awal -->
                    <div class="p-6 bg-blue-100 border border-blue-200 rounded-lg shadow-md">
                        <h3 class="mb-2 text-lg font-semibold text-blue-800">{{ __('Saldo Awal Bulan Ini') }}</h3>
                        <p class="text-3xl font-bold text-blue-900">
                            {{ 'Rp ' . number_format($initialBalance, 2, ',', '.') }}
                        </p>
                    </div>

                    <!-- Kartu Total Pengeluaran Bulan Ini -->
                    <div class="p-6 bg-red-100 border border-red-200 rounded-lg shadow-md">
                        <h3 class="mb-2 text-lg font-semibold text-red-800">{{ __('Total Pengeluaran Bulan Ini') }}</h3>
                        <p class="text-3xl font-bold text-red-900">
                            {{ 'Rp ' . number_format($totalExpensesThisMonth, 2, ',', '.') }}
                        </p>
                    </div>

                    <!-- Kartu Sisa Saldo -->
                    <div class="p-6 bg-green-100 border border-green-200 rounded-lg shadow-md">
                        <h3 class="mb-2 text-lg font-semibold text-green-800">{{ __('Sisa Saldo Bulan Ini') }}</h3>
                        <p class="text-3xl font-bold text-green-900">
                            {{ 'Rp ' . number_format($remainingBalance, 2, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Ringkasan Pengeluaran Tahunan -->
                    <div class="p-6 border border-yellow-200 rounded-lg shadow-md bg-yellow-50">
                        <h3 class="mb-2 text-lg font-semibold text-yellow-800">{{ __('Total Pengeluaran Tahun Ini') }}
                        </h3>
                        <p class="text-2xl font-bold text-yellow-900">
                            {{ 'Rp ' . number_format($totalExpensesThisYear, 2, ',', '.') }}
                        </p>
                        <p class="mt-2 text-sm text-gray-600">
                            Ringkasan pengeluaran Anda dari Januari hingga bulan ini.
                        </p>
                    </div>

                    <!-- Pengeluaran Berdasarkan Kategori (Bulan Ini) -->
                    <div class="p-6 border border-gray-200 rounded-lg shadow-md bg-gray-50">
                        <h3 class="mb-4 text-lg font-semibold text-gray-800">
                            {{ __('Pengeluaran Berdasarkan Kategori (Bulan Ini)') }}</h3>
                        @if ($expensesByCategory->isEmpty())
                            <p class="text-gray-600">Belum ada pengeluaran dicatat bulan ini.</p>
                        @else
                            <div class="space-y-4">
                                @foreach ($expensesByCategory as $categoryName => $amount)
                                    <div class="flex items-center">
                                        <div class="w-1/2">
                                            <p class="font-medium text-gray-700">{{ $categoryName }}</p>
                                        </div>
                                        <div class="w-1/2 text-right">
                                            <p class="font-semibold text-gray-900">
                                                {{ 'Rp ' . number_format($amount, 2, ',', '.') }}</p>
                                            <p class="text-sm text-gray-500">
                                                @if (isset($categoryPercentages[$categoryName]))
                                                    ({{ $categoryPercentages[$categoryName] }}%)
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        @if ($totalExpensesThisMonth > 0)
                                            <div class="bg-indigo-600 h-2.5 rounded-full"
                                                style="width: {{ $categoryPercentages[$categoryName] ?? 0 }}%"></div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-8 text-sm text-center text-gray-600">
                    <p>Data terakhir diperbarui: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
