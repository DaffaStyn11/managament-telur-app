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

        <!-- SIDEBAR -->
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
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Manajemen Telur</h2>
                    <p class="text-gray-600">Kelola data produksi telur dari setiap kandang dengan mudah dan efisien.</p>
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
                    <form method="GET" action="{{ route('telur.index') }}" class="relative w-full lg:max-w-md">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">
                            search
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full h-12 pl-12 pr-20 rounded-xl border border-gray-300 bg-white
                                      focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition text-sm"
                            placeholder="Cari tanggal, kuantitas...">
                        @if (request('search'))
                            <a href="{{ route('telur.index') }}"
                                class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-gray-600 transition"
                                title="Clear search">
                                <i data-feather="x" class="w-4 h-4"></i>
                            </a>
                        @endif
                    </form>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3 flex-wrap w-full lg:w-auto">


                        <a href="{{ route('telur.export.excel') }}"
                            class="flex h-12 items-center gap-2 rounded-xl border border-gray-300 px-4 text-sm font-semibold
                           bg-white hover:bg-gray-50 transition shadow-sm flex-1 lg:flex-none justify-center">
                            <span class="material-symbols-outlined text-xl text-green-600">grid_on</span>
                            <span class="hidden sm:inline">Excel</span>
                        </a>

                        <a href="{{ route('telur.export.pdf') }}"
                            class="flex h-12 items-center gap-2 rounded-xl border border-gray-300 px-4 text-sm font-semibold
                           bg-white hover:bg-gray-50 transition shadow-sm flex-1 lg:flex-none justify-center">
                            <span class="material-symbols-outlined text-xl text-red-600">picture_as_pdf</span>
                            <span class="hidden sm:inline">PDF</span>
                        </a>

                    </div>
                </div>



                <!-- TABLE TELUR -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

                    <div class="p-6 border-b border-gray-200">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Daftar Produksi Telur</h3>
                                <p class="text-sm text-gray-600">Data produksi telur terbaru dari kandang</p>
                            </div>

                            <button @click="$dispatch('open-create-modal')"
                                class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 rounded-xl shadow-md hover:shadow-lg font-semibold flex items-center justify-center gap-2 transition">
                                <i data-feather="plus" class="w-5 h-5"></i>
                                <span>Tambah Produksi</span>
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
                                        Tanggal</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Kuantitas</th>
                                    <th
                                        class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @forelse($telurs as $index => $telur)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                            {{ $telurs->firstItem() + $index }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $telur->tanggal->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="text-sm font-semibold text-gray-900">{{ number_format($telur->kuantitas) }}</span>
                                            <span class="text-xs text-gray-500 ml-1">butir</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <button
                                                    @click="$dispatch('open-edit-modal', { id: {{ $telur->id }}, tanggal: '{{ $telur->tanggal->format('Y-m-d') }}', kuantitas: {{ $telur->kuantitas }}, catatan: '{{ $telur->catatan }}' })"
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                                    title="Edit">
                                                    <i data-feather="edit-3" class="w-4 h-4"></i>
                                                </button>
                                                <form action="{{ route('telur.destroy', $telur->id) }}" method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                                        <td colspan="4" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <i data-feather="inbox" class="w-16 h-16 text-gray-300 mb-4"></i>
                                                <p class="text-gray-500 text-lg font-medium mb-2">Belum ada data produksi
                                                </p>
                                                <p class="text-gray-400 text-sm mb-4">Silakan tambahkan data produksi telur
                                                </p>
                                                <button @click="$dispatch('open-create-modal')"
                                                    class="px-6 py-2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 rounded-lg font-semibold hover:shadow-md transition">
                                                    Tambah Produksi
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($telurs->hasPages())
                        <div
                            class="flex flex-col sm:flex-row items-center justify-between px-6 py-4 border-t border-gray-200 gap-4">
                            <span class="text-sm text-gray-600">
                                Menampilkan <span class="font-semibold">{{ $telurs->firstItem() }}</span> -
                                <span class="font-semibold">{{ $telurs->lastItem() }}</span> dari
                                <span class="font-semibold">{{ $telurs->total() }}</span> entri
                            </span>

                            <div class="flex items-center gap-2">
                                {{ $telurs->links() }}
                            </div>
                        </div>
                    @endif

                </div>

            </main>

            @include('components.footer')

        </div>

    </div>

    <!-- CREATE MODAL -->
    @include('pages.telur.create')

    <!-- EDIT MODAL -->
    @include('pages.telur.edit')

    <script>
        feather.replace();

        // Update feather icons when Alpine re-renders
        document.addEventListener('alpine:initialized', () => {
            setTimeout(() => feather.replace(), 100);
        });
    </script>
@endsection
