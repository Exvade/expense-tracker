<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                </path>
            </svg>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Kategori Pengeluaran') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white border border-gray-100 shadow-xl sm:rounded-xl">
                <div class="p-4 text-gray-900 sm:p-6">
                    <!-- Pesan sukses atau error -->
                    @if (session('success'))
                        <div class="relative px-4 py-3 mb-6 text-green-800 border border-green-200 rounded-lg shadow-sm bg-green-50"
                            role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <strong class="font-semibold">Sukses!</strong>
                                    <span class="block ml-1 sm:inline">{{ session('success') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="relative px-4 py-3 mb-6 text-red-800 border border-red-200 rounded-lg shadow-sm bg-red-50"
                            role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <strong class="font-semibold">Error!</strong>
                                    <span class="block ml-1 sm:inline">{{ session('error') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Header Section -->
                    <div
                        class="flex flex-col items-start justify-between mb-6 space-y-3 sm:flex-row sm:items-center sm:space-y-0">
                        <div class="flex items-center">
                            <div class="p-2 mr-3 bg-purple-100 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Manajemen Kategori</h3>
                                <p class="text-sm text-gray-600">Kelola kategori pengeluaran Anda</p>
                            </div>
                        </div>

                        <a href="{{ route('categories.create') }}"
                            class="inline-flex items-center px-4 py-2 text-white transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            {{ __('Tambah Kategori Baru') }}
                        </a>
                    </div>

                    @if ($categories->isEmpty())
                        <div class="py-12 text-center">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada kategori</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan kategori pengeluaran pertama
                                Anda.</p>
                            <div class="mt-6">
                                <a href="{{ route('categories.create') }}"
                                    class="inline-flex items-center px-4 py-2 text-white transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    {{ __('Tambah Kategori') }}
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                        </path>
                                                    </svg>
                                                    {{ __('Nama Kategori') }}
                                                </div>
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zM12 14c-1.657 0-3 .895-3 2v1h6v-1c0-1.105-1.343-2-3-2zM4 5h16a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V6a1 1 0 011-1z">
                                                        </path>
                                                    </svg>
                                                    {{ __('Budget Maksimal') }}
                                                </div>
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    {{ __('Pengeluaran Bulan Ini') }}
                                                </div>
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M14 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ __('Sisa Budget') }}
                                                </div>
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                                        </path>
                                                    </svg>
                                                    {{ __('Aksi') }}
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($categories as $category)
                                            <tr class="transition-colors duration-150 hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg">
                                                            <svg class="w-5 h-5 text-purple-600" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $category->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                    {{ 'Rp ' . number_format($category->max_budget, 2, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                    {{ 'Rp ' . number_format($category->current_month_spend, 2, ',', '.') }}
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
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                    @php
                                                        $remainingClass = 'text-gray-900';
                                                        if ($category->remaining_budget < 0) {
                                                            $remainingClass = 'text-red-600 font-bold';
                                                        } elseif (
                                                            $category->remaining_budget <
                                                                $category->max_budget * 0.25 &&
                                                            $category->max_budget > 0
                                                        ) {
                                                            // Less than 25% remaining
                                                            $remainingClass = 'text-orange-600 font-bold';
                                                        }
                                                    @endphp
                                                    <span class="{{ $remainingClass }}">
                                                        {{ 'Rp ' . number_format($category->remaining_budget, 2, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div class="flex items-center space-x-3">
                                                        <a href="{{ route('categories.edit', $category->id) }}"
                                                            class="inline-flex items-center text-blue-600 transition-colors duration-150 hover:text-blue-900">
                                                            <svg class="w-4 h-4 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                                </path>
                                                            </svg>
                                                            {{ __('Edit') }}
                                                        </a>
                                                        <form
                                                            action="{{ route('categories.destroy', $category->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex items-center text-red-600 transition-colors duration-150 hover:text-red-900"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua pengeluaran yang terkait juga akan dihapus.')">
                                                                <svg class="w-4 h-4 mr-1" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                    </path>
                                                                </svg>
                                                                {{ __('Hapus') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Stats Card (already exists, no changes needed for this section but keeping it for context) -->
                        <div
                            class="p-4 mt-6 border border-purple-200 shadow-sm bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-semibold text-purple-800">Total Kategori</h4>
                                    <p class="text-lg font-bold text-purple-900">{{ $categories->count() }} kategori
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
