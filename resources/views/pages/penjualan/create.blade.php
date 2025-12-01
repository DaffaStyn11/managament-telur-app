<!-- CREATE MODAL -->
<div x-data="{ showCreateModal: {{ session('errors') && !request()->has('edit') ? 'true' : 'false' }} }" x-show="showCreateModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto"
    @keydown.escape.window="showCreateModal = false" @open-create-modal.window="showCreateModal = true">

    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="showCreateModal = false"
        x-show="showCreateModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    <!-- Modal Content -->
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="relative inline-block w-full max-w-2xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl"
            x-show="showCreateModal" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            @click.away="showCreateModal = false">

            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Tambah Penjualan</h3>
                    <p class="text-sm text-gray-600 mt-1">Catat transaksi penjualan telur</p>
                </div>
                <button @click="showCreateModal = false" class="p-2 hover:bg-gray-100 rounded-lg transition">
                    <i data-feather="x" class="w-5 h-5 text-gray-500"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <form action="{{ route('penjualan.store') }}" method="POST" class="p-6" x-data="{ jumlah: 0, harga: 0 }">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Tanggal -->
                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i data-feather="calendar" class="w-5 h-5"></i>
                            </span>
                            <input type="date" id="tanggal" name="tanggal"
                                value="{{ old('tanggal', date('Y-m-d')) }}"
                                class="w-full h-12 pl-12 pr-4 rounded-xl border border-gray-300 bg-white
                                          focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition
                                          @error('tanggal') border-red-500 @enderror">
                        </div>
                        @error('tanggal')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i data-feather="alert-circle" class="w-4 h-4"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Pelanggan -->
                    <div class="mb-4">
                        <label for="pelanggan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Pelanggan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i data-feather="user" class="w-5 h-5"></i>
                            </span>
                            <input type="text" id="pelanggan" name="pelanggan" value="{{ old('pelanggan') }}"
                                class="w-full h-12 pl-12 pr-4 rounded-xl border border-gray-300 bg-white
                                          focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition
                                          @error('pelanggan') border-red-500 @enderror"
                                placeholder="Contoh: Toko Sari">
                        </div>
                        @error('pelanggan')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i data-feather="alert-circle" class="w-4 h-4"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Jumlah -->
                    <div class="mb-4">
                        <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jumlah (butir) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i data-feather="hash" class="w-5 h-5"></i>
                            </span>
                            <input type="number" id="jumlah" name="jumlah" x-model="jumlah"
                                value="{{ old('jumlah') }}" min="1"
                                class="w-full h-12 pl-12 pr-4 rounded-xl border border-gray-300 bg-white
                                          focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition
                                          @error('jumlah') border-red-500 @enderror"
                                placeholder="Contoh: 100">
                        </div>
                        @error('jumlah')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i data-feather="alert-circle" class="w-4 h-4"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Harga Satuan -->
                    <div class="mb-4">
                        <label for="harga_satuan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Harga Satuan (Rp) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i data-feather="dollar-sign" class="w-5 h-5"></i>
                            </span>
                            <input type="number" id="harga_satuan" name="harga_satuan" x-model="harga"
                                value="{{ old('harga_satuan') }}" min="0" step="0.01"
                                class="w-full h-12 pl-12 pr-4 rounded-xl border border-gray-300 bg-white
                                          focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition
                                          @error('harga_satuan') border-red-500 @enderror"
                                placeholder="Contoh: 2000">
                        </div>
                        @error('harga_satuan')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i data-feather="alert-circle" class="w-4 h-4"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Total (calculated) -->
                <div class="mb-4 p-4 bg-gray-50 rounded-xl">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-gray-700">Total Harga:</span>
                        <span class="text-2xl font-bold text-gray-900"
                            x-text="'Rp ' + (jumlah * harga).toLocaleString('id-ID')"></span>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="mb-6">
                    <label for="catatan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Catatan (Opsional)
                    </label>
                    <div class="relative">
                        <textarea id="catatan" name="catatan" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white
                                         focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition
                                         @error('catatan') border-red-500 @enderror"
                            placeholder="Tambahkan catatan jika diperlukan...">{{ old('catatan') }}</textarea>
                    </div>
                    @error('catatan')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <i data-feather="alert-circle" class="w-4 h-4"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <button type="button" @click="showCreateModal = false"
                        class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold
                                   hover:bg-gray-200 transition text-center">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900
                                   rounded-xl shadow-md hover:shadow-lg font-semibold transition flex items-center
                                   justify-center gap-2">
                        <i data-feather="save" class="w-5 h-5"></i>
                        <span>Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
