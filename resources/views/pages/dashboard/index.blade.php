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
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Dashboard</h2>
                    <p class="text-gray-600">Selamat datang di sistem manajemen telur. Berikut adalah ringkasan data Anda.
                    </p>
                </div>

                <!-- STATISTICS CARDS -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

                    <!-- Total Stock Card -->
                    <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-2xl shadow-lg p-6 text-gray-900">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white bg-opacity-30 rounded-xl">
                                <span class="material-symbols-outlined text-3xl">egg</span>
                            </div>
                            <span class="text-sm font-semibold bg-white bg-opacity-30 px-3 py-1 rounded-full">Total
                                Stok</span>
                        </div>
                        <h3 class="text-4xl font-bold mb-2">{{ number_format($totalStok) }}</h3>
                        <p class="text-sm font-medium opacity-90">Butir Telur Tersedia</p>
                    </div>

                    <!-- Total Production Entries Card -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                                <span class="material-symbols-outlined text-3xl">inventory_2</span>
                            </div>
                            <span class="text-sm font-semibold bg-white bg-opacity-20 px-3 py-1 rounded-full">Data
                                Produksi</span>
                        </div>
                        <h3 class="text-4xl font-bold mb-2">{{ number_format($totalProduksi) }}</h3>
                        <p class="text-sm font-medium opacity-90">Total Entri Produksi</p>
                    </div>

                    <!-- Quick Action Card -->
                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                                <span class="material-symbols-outlined text-3xl">add_circle</span>
                            </div>
                            <span class="text-sm font-semibold bg-white bg-opacity-20 px-3 py-1 rounded-full">Aksi
                                Cepat</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Tambah Data</h3>
                        <a href="{{ route('telur.index') }}"
                            class="inline-flex items-center gap-2 bg-white text-green-600 px-4 py-2 rounded-lg font-semibold hover:bg-opacity-90 transition">
                            <span class="material-symbols-outlined text-xl">arrow_forward</span>
                            <span>Kelola Telur</span>
                        </a>
                    </div>

                </div>

                <!-- RECENT PRODUCTION -->
                @if ($produksiTerbaru->count() > 0)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-1">Produksi Terbaru</h3>
                                    <p class="text-sm text-gray-600">5 data produksi telur terbaru</p>
                                </div>
                                <a href="{{ route('telur.index') }}"
                                    class="text-yellow-600 hover:text-yellow-700 font-semibold text-sm flex items-center gap-1">
                                    <span>Lihat Semua</span>
                                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                                </a>
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
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($produksiTerbaru as $index => $telur)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                                {{ $index + 1 }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-700">
                                                {{ $telur->tanggal->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="text-sm font-semibold text-gray-900">{{ number_format($telur->kuantitas) }}</span>
                                                <span class="text-xs text-gray-500 ml-1">butir</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12">
                        <div class="flex flex-col items-center justify-center text-center">
                            <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">inbox</span>
                            <p class="text-gray-500 text-lg font-medium mb-2">Belum ada data produksi</p>
                            <p class="text-gray-400 text-sm mb-4">Silakan tambahkan data produksi telur untuk melihat
                                statistik</p>
                            <a href="{{ route('telur.index') }}"
                                class="px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 rounded-xl font-semibold hover:shadow-md transition">
                                Tambah Produksi
                            </a>
                        </div>
                    </div>
                @endif

            </main>

            @include('components.footer')

        </div>

    </div>

    <script>
        // Initialize Material Symbols if needed
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
@endsection
