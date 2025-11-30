@extends('layouts.app')
@section('content')

    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen && isMobile()"
         x-cloak
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
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
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Manajemen Penjualan</h2>
                    <p class="text-gray-600">Kelola dan pantau semua transaksi penjualan telur dengan mudah.</p>
                </div>

                <!-- Toolbar -->
                <div class="mb-6 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">

                    <!-- Search -->
                    <div class="relative w-full lg:max-w-md">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">
                            search
                        </span>
                        <input type="text"
                            class="w-full h-12 pl-12 pr-4 rounded-xl border border-gray-300 bg-white
                           focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition text-sm"
                            placeholder="Cari pelanggan atau tanggal penjualan...">
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3 flex-wrap w-full lg:w-auto">

                        <button
                            class="flex h-12 items-center gap-2 rounded-xl border border-gray-300 px-4 text-sm font-semibold
                           bg-white hover:bg-gray-50 transition shadow-sm flex-1 lg:flex-none justify-center">
                            <span class="material-symbols-outlined text-xl text-gray-600">calendar_month</span>
                            <span class="hidden sm:inline">Filter Tanggal</span>
                        </button>

                        <button
                            class="flex h-12 items-center gap-2 rounded-xl border border-gray-300 px-4 text-sm font-semibold
                           bg-white hover:bg-gray-50 transition shadow-sm flex-1 lg:flex-none justify-center">
                            <span class="material-symbols-outlined text-xl text-green-600">grid_on</span>
                            <span class="hidden sm:inline">Excel</span>
                        </button>

                        <button
                            class="flex h-12 items-center gap-2 rounded-xl border border-gray-300 px-4 text-sm font-semibold
                           bg-white hover:bg-gray-50 transition shadow-sm flex-1 lg:flex-none justify-center">
                            <span class="material-symbols-outlined text-xl text-red-600">picture_as_pdf</span>
                            <span class="hidden sm:inline">PDF</span>
                        </button>

                    </div>
                </div>

                <!-- CARD SUMMARY -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <i data-feather="dollar-sign" class="w-6 h-6 text-green-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Penjualan Hari Ini</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp 2.500.000</p>
                        <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                            <span>↑ 18%</span> vs kemarin
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i data-feather="bar-chart-2" class="w-6 h-6 text-blue-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Rata-rata Mingguan</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp 15.000.000</p>
                        <p class="text-xs text-gray-500 mt-2">per minggu</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                <i data-feather="calendar" class="w-6 h-6 text-purple-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Total Bulanan</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp 60.000.000</p>
                        <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                            <span>↑ 12%</span> bulan ini
                        </p>
                    </div>

                </div>

                <!-- TABLE PENJUALAN -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mb-8">

                    <div class="p-6 border-b border-gray-200">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Daftar Penjualan</h3>
                                <p class="text-sm text-gray-600">Riwayat transaksi penjualan telur</p>
                            </div>

                            <a href="#"
                                class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 rounded-xl shadow-md hover:shadow-lg font-semibold flex items-center justify-center gap-2 transition">
                                <i data-feather="plus" class="w-5 h-5"></i>
                                <span>Tambah Penjualan</span>
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">No</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Tanggal</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Pelanggan</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Jumlah</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Harga Satuan</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Total</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Status</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-700">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">1</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">27 Nov 2025</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <i data-feather="user" class="w-5 h-5 text-blue-600"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900">Toko Sari</p>
                                                <p class="text-xs text-gray-500">Pelanggan Tetap</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-semibold text-gray-900">120</span>
                                        <span class="text-xs text-gray-500 ml-1">butir</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Rp 2.000</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp 240.000</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                            Lunas
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                                <i data-feather="edit-3" class="w-4 h-4"></i>
                                            </button>
                                            <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition" title="Print">
                                                <i data-feather="printer" class="w-4 h-4"></i>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                <i data-feather="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">2</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">27 Nov 2025</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                                <i data-feather="user" class="w-5 h-5 text-purple-600"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900">Warung Makan Bu Tini</p>
                                                <p class="text-xs text-gray-500">Pelanggan Baru</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-semibold text-gray-900">90</span>
                                        <span class="text-xs text-gray-500 ml-1">butir</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Rp 2.000</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp 180.000</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                            Lunas
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                                <i data-feather="edit-3" class="w-4 h-4"></i>
                                            </button>
                                            <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition" title="Print">
                                                <i data-feather="printer" class="w-4 h-4"></i>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                <i data-feather="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">3</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">26 Nov 2025</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                                <i data-feather="user" class="w-5 h-5 text-orange-600"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900">Pasar Sentral</p>
                                                <p class="text-xs text-gray-500">Pelanggan Tetap</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-semibold text-gray-900">110</span>
                                        <span class="text-xs text-gray-500 ml-1">butir</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Rp 2.000</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp 220.000</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                                <i data-feather="edit-3" class="w-4 h-4"></i>
                                            </button>
                                            <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition" title="Print">
                                                <i data-feather="printer" class="w-4 h-4"></i>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                <i data-feather="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="flex flex-col sm:flex-row items-center justify-between px-6 py-4 border-t border-gray-200 gap-4">
                        <span class="text-sm text-gray-600">Menampilkan <span class="font-semibold">1-3</span> dari <span class="font-semibold">50</span> entri</span>

                        <div class="flex items-center gap-2">
                            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed">
                                Sebelumnya
                            </button>
                            <button class="px-4 py-2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 rounded-lg hover:shadow-md transition text-sm font-semibold">
                                1
                            </button>
                            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                2
                            </button>
                            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                3
                            </button>
                            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                Selanjutnya
                            </button>
                        </div>
                    </div>

                </div>

                <!-- GRAFIK PENJUALAN -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Grafik Penjualan</h3>
                        <p class="text-sm text-gray-600">Tren penjualan 6 bulan terakhir</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl border border-green-200">
                            <p class="text-green-700 text-sm font-medium mb-1">Total Penjualan</p>
                            <p class="text-2xl font-bold text-green-900">Rp 7.500.000</p>
                            <p class="text-xs text-green-600 mt-1 flex items-center gap-1">
                                <span>↑ 12%</span> vs bulan lalu
                            </p>
                        </div>

                        <div class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                            <p class="text-blue-700 text-sm font-medium mb-1">Rata-rata Per Hari</p>
                            <p class="text-2xl font-bold text-blue-900">Rp 250.000</p>
                            <p class="text-xs text-blue-600 mt-1">30 hari terakhir</p>
                        </div>

                        <div class="p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl border border-purple-200">
                            <p class="text-purple-700 text-sm font-medium mb-1">Jumlah Transaksi</p>
                            <p class="text-2xl font-bold text-purple-900">145</p>
                            <p class="text-xs text-purple-600 mt-1">bulan ini</p>
                        </div>
                    </div>

                    <div class="h-80">
                        <canvas id="chartPenjualan"></canvas>
                    </div>
                </div>

            </main>

            <!-- FOOTER -->
            @include('components.footer')

        </div>

    </div>
    @include('components.scripts')
    {{-- <script>
        feather.replace();

        // Update feather icons when Alpine re-renders
        document.addEventListener('alpine:initialized', () => {
            setTimeout(() => feather.replace(), 100);
        });

        // Chart Penjualan
        const ctx = document.getElementById('chartPenjualan').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: [4000000, 4500000, 5000000, 5500000, 7000000, 7500000],
                    backgroundColor: 'rgba(251, 191, 36, 0.8)',
                    borderColor: 'rgb(251, 191, 36)',
                    borderWidth: 2,
                    borderRadius: 8,
                    barPercentage: 0.7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 12,
                                family: 'Inter'
                            },
                            padding: 15
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: {
                            size: 14,
                            family: 'Inter'
                        },
                        bodyFont: {
                            size: 13,
                            family: 'Inter'
                        },
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 11,
                                family: 'Inter'
                            },
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000) + 'jt';
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 11,
                                family: 'Inter'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script> --}}
@endsection
