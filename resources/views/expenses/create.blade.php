<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Tambah Pengeluaran Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white border border-gray-100 shadow-xl sm:rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Form Pengeluaran</h3>
                    </div>
                </div>

                <div class="p-6 text-gray-900 sm:p-8">
                    <form method="POST" action="{{ route('expenses.store') }}" class="space-y-6">
                        @csrf

                        <!-- Tanggal Pengeluaran -->
                        <div class="space-y-2">
                            <x-input-label for="expense_date" :value="__('Tanggal Pengeluaran')"
                                class="flex items-center text-sm font-medium text-gray-700" />
                            <div class="relative">
                                <x-text-input id="expense_date"
                                    class="block w-full py-3 pl-10 pr-3 transition-colors duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    type="date" name="expense_date" :value="old('expense_date', date('Y-m-d'))" required />
                                <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <x-input-error :messages="$errors->get('expense_date')" class="mt-2" />
                        </div>

                        <!-- Jumlah -->
                        <div class="space-y-2">
                            <x-input-label for="amount" :value="__('Jumlah (Rp)')"
                                class="flex items-center text-sm font-medium text-gray-700" />
                            <div class="relative">
                                <x-text-input id="amount"
                                    class="block w-full py-3 pl-10 pr-3 transition-colors duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    type="number" name="amount" :value="old('amount')" required step="0.01"
                                    min="0" placeholder="Masukkan jumlah pengeluaran" />
                                <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                    </path>
                                </svg>
                            </div>
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <!-- Kategori -->
                        <div class="space-y-2">
                            <x-input-label for="category_id" :value="__('Kategori')"
                                class="flex items-center text-sm font-medium text-gray-700" />
                            <div class="relative">
                                <select id="category_id" name="category_id"
                                    class="block w-full py-3 pl-10 pr-8 transition-colors duration-200 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                    <option value="">{{ __('Pilih Kategori') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                            </div>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="space-y-2">
                            <x-input-label for="description" :value="__('Deskripsi')"
                                class="flex items-center text-sm font-medium text-gray-700" />
                            <div class="relative">
                                <textarea id="description" name="description" rows="4"
                                    class="block w-full py-3 pl-10 pr-3 transition-colors duration-200 border border-gray-300 rounded-lg resize-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan deskripsi pengeluaran (opsional)">{{ old('description') }}</textarea>
                                <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                            </div>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Action Buttons -->
                        <div
                            class="flex flex-col items-center justify-between pt-6 space-y-3 border-t border-gray-200 sm:flex-row sm:space-y-0">
                            <a href="{{ route('expenses.index') }}"
                                class="inline-flex items-center px-4 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                {{ __('Kembali') }}
                            </a>

                            <x-primary-button
                                class="inline-flex items-center px-6 py-3 transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:ring-blue-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ __('Simpan Pengeluaran') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="p-4 mt-6 border border-blue-200 shadow-sm bg-blue-50 rounded-xl">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="mb-1 text-sm font-semibold text-blue-800">Tips Pengisian Form</h4>
                        <ul class="space-y-1 text-sm text-blue-700">
                            <li>• Pastikan tanggal pengeluaran sesuai dengan waktu transaksi</li>
                            <li>• Masukkan jumlah dalam format angka (contoh: 50000 untuk Rp 50.000)</li>
                            <li>• Pilih kategori yang sesuai untuk memudahkan pelaporan</li>
                            <li>• Deskripsi membantu Anda mengingat detail pengeluaran</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
