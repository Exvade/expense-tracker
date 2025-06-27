<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Kategori Pengeluaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Pesan sukses atau error -->
                    @if (session('success'))
                        <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded"
                            role="alert">
                            <strong class="font-bold">Sukses!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="relative px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="flex items-center justify-between mb-4">
                        <a href="{{ route('categories.create') }}"
                            class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Tambah Kategori Baru') }}
                        </a>
                    </div>

                    @if ($categories->isEmpty())
                        <p class="py-4 text-center text-gray-600">Belum ada kategori yang ditambahkan.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            {{ __('Nama Kategori') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            {{ __('Aksi') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                {{ $category->name }}
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                    class="mr-3 text-indigo-600 hover:text-indigo-900">
                                                    {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua pengeluaran yang terkait juga akan dihapus.')">
                                                        {{ __('Hapus') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
