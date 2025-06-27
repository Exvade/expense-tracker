<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Pengeluaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('expenses.update', $expense->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Tanggal Pengeluaran -->
                        <div class="mb-4">
                            <x-input-label for="expense_date" :value="__('Tanggal Pengeluaran')" />
                            <x-text-input id="expense_date" class="block w-full mt-1" type="date" name="expense_date"
                                :value="old('expense_date', $expense->expense_date->format('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('expense_date')" class="mt-2" />
                        </div>

                        <!-- Jumlah -->
                        <div class="mb-4">
                            <x-input-label for="amount" :value="__('Jumlah (Rp)')" />
                            <x-text-input id="amount" class="block w-full mt-1" type="number" name="amount"
                                :value="old('amount', $expense->amount)" required step="0.01" min="0" />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <x-input-label for="category_id" :value="__('Kategori')" />
                            <select id="category_id" name="category_id"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                <option value="">{{ __('Pilih Kategori') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $expense->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            <textarea id="description" name="description" rows="3"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $expense->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Update Pengeluaran') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
