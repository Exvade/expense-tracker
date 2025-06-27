<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Bagian Baru untuk Saldo Awal -->
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Perbarui Saldo Awal') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Atur atau perbarui saldo awal Anda untuk perhitungan pengeluaran.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('profile.update-initial-balance') }}"
                            class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <x-input-label for="initial_balance" :value="__('Saldo Awal')" />
                                <x-text-input id="initial_balance" name="initial_balance" type="number" step="0.01"
                                    min="0" class="block w-full mt-1" :value="old('initial_balance', Auth::user()->initial_balance)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('initial_balance')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Simpan') }}</x-primary-button>

                                @if (session('status') === 'initial-balance-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Disimpan.') }}</p>
                                @endif
                            </div>
                        </form>
                </div>
            </div>
            <!-- Akhir Bagian Baru untuk Saldo Awal -->


            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
