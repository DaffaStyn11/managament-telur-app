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
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Manajemen Pengeluaran</h2>
                    <p class="text-gray-600">Kelola dan pantau semua pengeluaran operasional peternakan.</p>
                </div>

                <!-- Toolbar -->
                <div class="mb-6 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">

                    <!-- Search -->
                    <div class="relative w-full lg:max-w-md">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">
                            search
                        </span>
                        <input type="text"
                            class="w-full h-12 pl-12 pr-4 rounded-xl border border-gray-300 bg-white
                           focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition text-sm"
                            placeholder="Cari kategori atau nama barang...">
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
                            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                                <i data-feather="credit-card" class="w-6 h-6 text-red-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Pengeluaran Hari Ini</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp 750.000</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                                <i data-feather="trending-down" class="w-6 h-6 text-orange-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Pengeluaran Mingguan</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp 4.500.000</p>
                        <p class="text-xs text-gray-500 mt-2">per minggu</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                <i data-feather="calendar" class="w-6 h-6 text-purple-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Pengeluaran Bulanan</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp 18.000.000</p>
                    </div>

                </div>

                <!-- TABLE PENGELUARAN -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mb-8">

                    <div class="p-6 border-b border-gray-200">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Daftar Pengeluaran</h3>
                                <p class="text-sm text-gray-600">Riwayat semua pengeluaran operasional</p>
                            </div>

                            <a href="#"
                                class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 rounded-xl shadow-md hover:shadow-lg font-semibold flex items-center justify-center gap-2 transition">
                                <i data-feather="plus" class="w-5 h-5"></i>
                                <span>Tambah Pengeluaran</span>
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
                                        Pembelian</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Jumlah</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Harga Satuan</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Total</th>
                                    <th
                                        class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">1</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">27 Nov 2025</td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">Vitamin VitaStress</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-semibold text-gray-900">2</span>
                                        <span class="text-xs text-gray-500 ml-1">botol</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Rp 25.000</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp 50.000</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                                title="Edit">
                                                <i data-feather="edit-3" class="w-4 h-4"></i>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition"
                                                title="Hapus">
                                                <i data-feather="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div
                        class="flex flex-col sm:flex-row items-center justify-between px-6 py-4 border-t border-gray-200 gap-4">
                        <span class="text-sm text-gray-600">Menampilkan <span class="font-semibold">1-3</span> dari <span
                                class="font-semibold">32</span> entri</span>

                        <div class="flex items-center gap-2">
                            <button
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed">
                                Sebelumnya
                            </button>
                            <button
                                class="px-4 py-2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 rounded-lg hover:shadow-md transition text-sm font-semibold">
                                1
                            </button>
                            <button
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                2
                            </button>
                            <button
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                3
                            </button>
                            <button
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                Selanjutnya
                            </button>
                        </div>
                    </div>

                </div>

            </main>

            <!-- FOOTER -->
            @include('components.footer')

        </div>

    </div>
    @include('components.scripts')
    <script>
        feather.replace();

        // Update feather icons when Alpine re-renders
        document.addEventListener('alpine:initialized', () => {
            setTimeout(() => feather.replace(), 100);
        });

        // STYLE GLOBAL
        Chart.defaults.font.family = "Inter";
        Chart.defaults.color = "#475569";
        Chart.defaults.borderColor = "rgba(0,0,0,0.08)";

        // --- GRAFIK PENGELUARAN (LINE CHART) ---
        const ctxPengeluaran = document.getElementById('chartPengeluaran').getContext('2d');
        new Chart(ctxPengeluaran, {
            type: 'line',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni"],
                datasets: [{
                    label: "Pengeluaran",
                    data: [1200000, 1400000, 1300000, 1500000, 1600000, 1550000],
                    borderWidth: 3,
                    borderColor: "#ef4444",
                    backgroundColor: "rgba(239,68,68,0.15)",
                    fill: true,
                    tension: 0.35,
                    pointRadius: 5,
                    pointBackgroundColor: "#ef4444",
                    pointHoverRadius: 7,
                    pointBorderWidth: 2,
                    pointBorderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        titleColor: "#fff",
                        bodyColor: "#fff",
                        padding: 12,
                        borderWidth: 0,
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
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                size: 11,
                                family: 'Inter'
                            },
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000) + 'jt';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                family: 'Inter'
                            }
                        }
                    }
                }
            }
        });

        // --- GRAFIK PERBANDINGAN (BAR CHART) ---
        const ctxBanding = document.getElementById('chartBanding').getContext('2d');
        new Chart(ctxBanding, {
            type: 'bar',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei"],
                datasets: [{
                        label: "Pengeluaran",
                        data: [1200000, 1400000, 1300000, 1500000, 1600000],
                        backgroundColor: "rgba(239,68,68,0.8)",
                        borderColor: "#ef4444",
                        borderWidth: 2,
                        borderRadius: 8,
                        barPercentage: 0.7
                    },
                    {
                        label: "Penjualan",
                        data: [2000000, 2200000, 2100000, 2500000, 3000000],
                        backgroundColor: "rgba(16,185,129,0.8)",
                        borderColor: "#10b981",
                        borderWidth: 2,
                        borderRadius: 8,
                        barPercentage: 0.7
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        titleColor: "#fff",
                        bodyColor: "#fff",
                        padding: 12,
                        borderWidth: 0,
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
                    },
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 12,
                                family: 'Inter'
                            },
                            padding: 15,
                            boxWidth: 12,
                            boxHeight: 12,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                size: 11,
                                family: 'Inter'
                            },
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000) + 'jt';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                family: 'Inter'
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
