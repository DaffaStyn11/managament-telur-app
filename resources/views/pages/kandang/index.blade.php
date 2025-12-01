@extends('layouts.app')
@section('content')
    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen && isMobile()" x-cloak @click="sidebarOpen = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <!-- MAIN LAYOUT -->
    <div class="min-h-screen flex relative">
        @include('components.sidebar')

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col min-h-screen w-full transition-all duration-300 ease-in-out"
            :style="!isMobile() && sidebarOpen ? 'margin-left: 288px' : 'margin-left: 0'">

            <!-- HEADER -->
            @include('components.header')

            <!-- CONTENT AREA -->
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

                <!-- TITLE -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Manajemen Kandang</h2>
                    <p class="text-gray-600">Kelola kandang ayam Anda secara efisien dengan sistem terintegrasi.</p>
                </div>

                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i data-feather="check-circle" class="w-5 h-5 text-green-500 mr-3"></i>
                            <p class="text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i data-feather="alert-circle" class="w-5 h-5 text-red-500 mr-3"></i>
                            <p class="text-red-700 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Toolbar -->
                <div class="mb-6 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">

                    <!-- Search -->
                    <form method="GET" action="{{ route('kandang.index') }}" class="relative w-full lg:max-w-md">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">
                            search
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full h-12 pl-12 pr-20 rounded-xl border border-gray-300 bg-white
                                      focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition text-sm"
                            placeholder="Cari nama kandang, blok, atau jenis ayam...">
                        @if (request('search'))
                            <a href="{{ route('kandang.index') }}"
                                class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-gray-600 transition"
                                title="Clear search">
                                <i data-feather="x" class="w-4 h-4"></i>
                            </a>
                        @endif
                    </form>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3 flex-wrap w-full lg:w-auto">


                        <a href="{{ route('kandang.export.excel') }}"
                            class="flex h-12 items-center gap-2 rounded-xl border border-gray-300 px-4 text-sm font-semibold
                           bg-white hover:bg-gray-50 transition shadow-sm flex-1 lg:flex-none justify-center">
                            <span class="material-symbols-outlined text-xl text-green-600">grid_on</span>
                            <span class="hidden sm:inline">Excel</span>
                        </a>

                        <a href="{{ route('kandang.export.pdf') }}"
                            class="flex h-12 items-center gap-2 rounded-xl border border-gray-300 px-4 text-sm font-semibold
                           bg-white hover:bg-gray-50 transition shadow-sm flex-1 lg:flex-none justify-center">
                            <span class="material-symbols-outlined text-xl text-red-600">picture_as_pdf</span>
                            <span class="hidden sm:inline">PDF</span>
                        </a>

                    </div>
                </div>

                <!-- TABLE KANDANG -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

                    <div class="p-6 border-b border-gray-200">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Daftar Kandang</h3>
                                <p class="text-sm text-gray-600">Kelola dan pantau semua kandang ayam</p>
                            </div>

                            <button @click="$dispatch('open-create-modal')"
                                class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 rounded-xl shadow-md hover:shadow-lg font-semibold flex items-center justify-center gap-2 transition">
                                <i data-feather="plus" class="w-5 h-5"></i>
                                <span>Tambah Kandang</span>
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        No</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Nama Kandang</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Jumlah Ayam</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Jenis Ayam</th>
                                    <th
                                        class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @forelse($kandangs as $index => $kandang)
                                    @php
                                        $colors = ['blue', 'purple', 'green', 'orange', 'indigo', 'pink', 'teal'];
                                        $color = $colors[$index % count($colors)];
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                            {{ $kandangs->firstItem() + $index }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 bg-{{ $color }}-100 rounded-lg flex items-center justify-center">
                                                    <i data-feather="home" class="w-5 h-5 text-{{ $color }}-600"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-900">
                                                        {{ $kandang->nama_kandang }}</p>
                                                    <p class="text-xs text-gray-500">{{ $kandang->blok }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="text-sm font-semibold text-gray-900">{{ $kandang->jumlah_ayam }}</span>
                                            <span class="text-xs text-gray-500 ml-1">ekor</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                                {{ str_contains(strtolower($kandang->jenis_ayam), 'golden') || str_contains(strtolower($kandang->jenis_ayam), 'red') ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $kandang->jenis_ayam }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <button
                                                    @click="$dispatch('open-edit-modal', { id: {{ $kandang->id }}, nama_kandang: '{{ $kandang->nama_kandang }}', blok: '{{ $kandang->blok }}', jumlah_ayam: {{ $kandang->jumlah_ayam }}, jenis_ayam: '{{ $kandang->jenis_ayam }}' })"
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                                    title="Edit">
                                                    <i data-feather="edit-3" class="w-4 h-4"></i>
                                                </button>
                                                <form action="{{ route('kandang.destroy', $kandang->id) }}" method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus kandang ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition"
                                                        title="Hapus">
                                                        <i data-feather="trash-2" class="w-4 h-4"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <i data-feather="inbox" class="w-16 h-16 text-gray-300 mb-4"></i>
                                                <p class="text-gray-500 text-lg font-medium mb-2">Belum ada data kandang
                                                </p>
                                                <p class="text-gray-400 text-sm mb-4">Silakan tambahkan kandang baru untuk
                                                    memulai</p>
                                                <button @click="$dispatch('open-create-modal')"
                                                    class="px-6 py-2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 rounded-lg font-semibold hover:shadow-md transition">
                                                    Tambah Kandang
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($kandangs->hasPages())
                        <div
                            class="flex flex-col sm:flex-row items-center justify-between px-6 py-4 border-t border-gray-200 gap-4">
                            <span class="text-sm text-gray-600">
                                Menampilkan <span class="font-semibold">{{ $kandangs->firstItem() }}</span> -
                                <span class="font-semibold">{{ $kandangs->lastItem() }}</span> dari
                                <span class="font-semibold">{{ $kandangs->total() }}</span> entri
                            </span>

                            <div class="flex items-center gap-2">
                                {{ $kandangs->links() }}
                            </div>
                        </div>
                    @endif

                </div>

            </main>

            <!-- FOOTER -->
            @include('components.footer')

        </div>

    </div>

    <!-- CREATE MODAL -->
    @include('pages.kandang.create')

    <!-- EDIT MODAL -->
    @include('pages.kandang.edit')

    <script>
        feather.replace();

        // Update feather icons when Alpine re-renders
        document.addEventListener('alpine:initialized', () => {
            setTimeout(() => feather.replace(), 100);
        });
    </script>
@endsection
