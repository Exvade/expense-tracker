<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                </path>
            </svg>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit Kategori') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white border border-gray-100 shadow-xl sm:rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3 text-orange-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Edit Form Kategori</h3>
                    </div>
                </div>

                <div class="p-6 text-gray-900 sm:p-8">
                    <!-- Success/Error Messages -->
                    @if (session('success'))
                        <div class="relative px-4 py-3 mb-6 text-green-700 bg-green-100 border border-green-400 rounded"
                            role="alert">
                            <strong class="font-bold">Sukses!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="relative px-4 py-3 mb-6 text-red-700 bg-red-100 border border-red-400 rounded"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('categories.update', $category->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nama Kategori -->
                        <div class="space-y-2">
                            <x-input-label for="name" :value="__('Nama Kategori')"
                                class="flex items-center text-sm font-medium text-gray-700" />
                            <div class="relative">
                                <x-text-input id="name"
                                    class="block w-full py-3 pl-10 pr-3 transition-colors duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                    type="text" name="name" :value="old('name', $category->name)" required autofocus
                                    placeholder="Masukkan nama kategori" />
                                <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Budget Maksimal -->
                        <div class="space-y-2">
                            <x-input-label for="max_budget" :value="__('Budget Maksimal (Rp)')"
                                class="flex items-center text-sm font-medium text-gray-700" />
                            <div class="relative">
                                <x-text-input id="max_budget"
                                    class="block w-full py-3 pl-3 pr-3 transition-colors duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                    type="number" name="max_budget" :value="old('max_budget', $category->max_budget)" required step="0.01"
                                    min="0" placeholder="Masukkan budget maksimal (contoh: 500000)" />
                                <!-- No specific icon provided for budget, so using a standard text input field for now. -->
                            </div>
                            <x-input-error :messages="$errors->get('max_budget')" class="mt-2" />
                        </div>


                        <!-- Action Buttons -->
                        <div
                            class="flex flex-col items-center justify-between pt-6 space-y-3 border-t border-gray-200 sm:flex-row sm:space-y-0">
                            <a href="{{ route('categories.index') }}"
                                class="inline-flex items-center px-4 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                {{ __('Kembali') }}
                            </a>

                            <x-primary-button
                                class="inline-flex items-center px-6 py-3 transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 focus:ring-orange-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                {{ __('Update Kategori') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Data Info Card -->
            <div class="p-4 mt-6 border border-orange-200 shadow-sm bg-orange-50 rounded-xl">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-orange-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">
                        <h4 class="mb-2 text-sm font-semibold text-orange-800">Data Kategori Saat Ini</h4>
                        <div class="space-y-1">
                            <div class="flex items-center text-sm text-orange-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                                <span class="font-medium">Nama Kategori:</span>
                                <span
                                    class="px-2 py-1 ml-1 font-semibold bg-orange-200 rounded-md">{{ $category->name }}</span>
                            </div>
                            <div class="flex items-center text-sm text-orange-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zM12 14c-1.657 0-3 .895-3 2v1h6v-1c0-1.105-1.343-2-3-2zM4 5h16a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V6a1 1 0 011-1z">
                                    </path>
                                </svg>
                                <span class="font-medium">Budget Maksimal:</span>
                                <span
                                    class="px-2 py-1 ml-1 font-semibold bg-orange-200 rounded-md">{{ 'Rp ' . number_format($category->max_budget, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="p-4 mt-4 border border-blue-200 shadow-sm bg-blue-50 rounded-xl">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="mb-1 text-sm font-semibold text-blue-800">Tips Edit Kategori</h4>
                        <ul class="space-y-1 text-sm text-blue-700">
                            <li>• Gunakan nama yang jelas dan mudah diingat</li>
                            <li>• Hindari nama kategori yang terlalu panjang</li>
                            <li>• Pastikan nama kategori tidak duplikat dengan yang sudah ada</li>
                            <li>• Perubahan akan mempengaruhi semua pengeluaran dengan kategori ini</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
