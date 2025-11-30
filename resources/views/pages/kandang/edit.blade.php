  <div x-data="{
      showEditModal: {{ session('errors') && request()->has('edit') ? 'true' : 'false' }},
      editData: {
          id: '{{ old('id', '') }}',
          nama_kandang: '{{ old('nama_kandang', '') }}',
          blok: '{{ old('blok', '') }}',
          jumlah_ayam: '{{ old('jumlah_ayam', '') }}',
          jenis_ayam: '{{ old('jenis_ayam', '') }}'
      },
      openEditModal(kandang) {
          this.editData = kandang;
          this.showEditModal = true;
      }
  }" x-show="showEditModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto"
      @keydown.escape.window="showEditModal = false" @open-edit-modal.window="openEditModal($event.detail)">

      <!-- Backdrop -->
      <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="showEditModal = false"
          x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
          x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
      </div>

      <!-- Modal Content -->
      <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
          <div class="relative inline-block w-full max-w-2xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl"
              x-show="showEditModal" x-transition:enter="ease-out duration-300"
              x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
              x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
              x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
              x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
              @click.away="showEditModal = false">

              <!-- Modal Header -->
              <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                  <div>
                      <h3 class="text-xl font-bold text-gray-900">Edit Kandang</h3>
                      <p class="text-sm text-gray-600 mt-1">Perbarui informasi kandang</p>
                  </div>
                  <button @click="showEditModal = false" class="p-2 hover:bg-gray-100 rounded-lg transition">
                      <i data-feather="x" class="w-5 h-5 text-gray-500"></i>
                  </button>
              </div>

              <!-- Modal Body -->
              <form :action="`{{ route('kandang.index') }}/${editData.id}`" method="POST" class="p-6">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="edit" value="1">

                  <!-- Nama Kandang -->
                  <div class="mb-4">
                      <label for="edit_nama_kandang" class="block text-sm font-semibold text-gray-700 mb-2">
                          Nama Kandang <span class="text-red-500">*</span>
                      </label>
                      <div class="relative">
                          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                              <i data-feather="home" class="w-5 h-5"></i>
                          </span>
                          <input type="text" id="edit_nama_kandang" name="nama_kandang"
                              x-model="editData.nama_kandang"
                              class="w-full h-12 pl-12 pr-4 rounded-xl border border-gray-300 bg-white
                                          focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition
                                          @error('nama_kandang') border-red-500 @enderror"
                              placeholder="Contoh: Kandang 1">
                      </div>
                      @error('nama_kandang')
                          <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                              <i data-feather="alert-circle" class="w-4 h-4"></i>
                              {{ $message }}
                          </p>
                      @enderror
                  </div>

                  <!-- Blok -->
                  <div class="mb-4">
                      <label for="edit_blok" class="block text-sm font-semibold text-gray-700 mb-2">
                          Blok <span class="text-red-500">*</span>
                      </label>
                      <div class="relative">
                          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                              <i data-feather="map-pin" class="w-5 h-5"></i>
                          </span>
                          <input type="text" id="edit_blok" name="blok" x-model="editData.blok"
                              class="w-full h-12 pl-12 pr-4 rounded-xl border border-gray-300 bg-white
                                          focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition
                                          @error('blok') border-red-500 @enderror"
                              placeholder="Contoh: Blok A">
                      </div>
                      @error('blok')
                          <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                              <i data-feather="alert-circle" class="w-4 h-4"></i>
                              {{ $message }}
                          </p>
                      @enderror
                  </div>

                  <!-- Jumlah Ayam -->
                  <div class="mb-4">
                      <label for="edit_jumlah_ayam" class="block text-sm font-semibold text-gray-700 mb-2">
                          Jumlah Ayam <span class="text-red-500">*</span>
                      </label>
                      <div class="relative">
                          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                              <i data-feather="hash" class="w-5 h-5"></i>
                          </span>
                          <input type="number" id="edit_jumlah_ayam" name="jumlah_ayam" x-model="editData.jumlah_ayam"
                              min="0"
                              class="w-full h-12 pl-12 pr-4 rounded-xl border border-gray-300 bg-white
                                          focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition
                                          @error('jumlah_ayam') border-red-500 @enderror"
                              placeholder="Contoh: 120">
                      </div>
                      @error('jumlah_ayam')
                          <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                              <i data-feather="alert-circle" class="w-4 h-4"></i>
                              {{ $message }}
                          </p>
                      @enderror
                  </div>

                  <!-- Jenis Ayam -->
                  <div class="mb-6">
                      <label for="edit_jenis_ayam" class="block text-sm font-semibold text-gray-700 mb-2">
                          Jenis Ayam <span class="text-red-500">*</span>
                      </label>
                      <div class="relative">
                          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                              <i data-feather="feather" class="w-5 h-5"></i>
                          </span>
                          <input type="text" id="edit_jenis_ayam" name="jenis_ayam" x-model="editData.jenis_ayam"
                              class="w-full h-12 pl-12 pr-4 rounded-xl border border-gray-300 bg-white
                                          focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition
                                          @error('jenis_ayam') border-red-500 @enderror"
                              placeholder="Contoh: Golden Red">
                      </div>
                      @error('jenis_ayam')
                          <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                              <i data-feather="alert-circle" class="w-4 h-4"></i>
                              {{ $message }}
                          </p>
                      @enderror
                  </div>

                  <!-- Action Buttons -->
                  <div class="flex gap-3 pt-4 border-t border-gray-200">
                      <button type="button" @click="showEditModal = false"
                          class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold
                                       hover:bg-gray-200 transition text-center">
                          Batal
                      </button>
                      <button type="submit"
                          class="flex-1 px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 
                                       rounded-xl shadow-md hover:shadow-lg font-semibold transition flex items-center 
                                       justify-center gap-2">
                          <i data-feather="save" class="w-5 h-5"></i>
                          <span>Update</span>
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
