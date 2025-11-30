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
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Pembukuan</h2>
                    <p class="text-gray-600">Ringkasan keuangan dan laporan lengkap peternakan Anda.</p>
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
                            placeholder="Cari transaksi atau periode...">
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
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Total Pengeluaran</h3>
                        <p class="text-3xl font-bold text-red-600">Rp 18.000.000</p>
                        <p class="text-xs text-gray-500 mt-2">bulan ini</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i data-feather="shopping-bag" class="w-6 h-6 text-blue-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Total Penjualan</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp 42.000.000</p>
                        <p class="text-xs text-blue-600 mt-2 flex items-center gap-1">
                            <span>↑ 15%</span> vs bulan lalu
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <i data-feather="wallet" class="w-6 h-6 text-green-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Saldo Akhir</h3>
                        <p class="text-3xl font-bold text-green-600">Rp 24.000.000</p>
                        <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                            <span>↑ 133%</span> profit margin
                        </p>
                    </div>

                </div>

                <!-- TABLE PEMBUKUAN -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mb-8">

                    <div class="p-6 border-b border-gray-200">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Data Pembukuan</h3>
                                <p class="text-sm text-gray-600">Catatan transaksi keuangan periode November 2025</p>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">No</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Periode</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Deskripsi</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Penjualan</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Pengeluaran</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Saldo</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">1</td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">November 2025</p>
                                            <p class="text-xs text-gray-500">Periode Bulanan</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                                <i data-feather="trending-up" class="w-4 h-4 text-green-600"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900">Penjualan Telur</p>
                                                <p class="text-xs text-gray-500">Revenue stream</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-green-600">Rp 42.000.000</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">-</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            + Rp 42.000.000
                                        </span>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">2</td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">November 2025</p>
                                            <p class="text-xs text-gray-500">Periode Bulanan</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                                <i data-feather="trending-down" class="w-4 h-4 text-red-600"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900">Pembelian Pakan</p>
                                                <p class="text-xs text-gray-500">Operational expense</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">-</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-red-600">Rp 18.000.000</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            - Rp 18.000.000
                                        </span>
                                    </td>
                                </tr>
                                <tr class="bg-gray-50 font-semibold">
                                    <td colspan="3" class="px-6 py-4 text-sm text-gray-900">Total</td>
                                    <td class="px-6 py-4 text-sm text-green-600">Rp 42.000.000</td>
                                    <td class="px-6 py-4 text-sm text-red-600">Rp 18.000.000</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-800">
                                            Rp 24.000.000
                                        </span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
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

                </div>



                <!-- GRAFIK SECTION -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <!-- GRAFIK CASHFLOW -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">Grafik Arus Kas</h3>
                            <p class="text-sm text-gray-600">Cash flow 6 bulan terakhir</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl border border-green-200">
                                <p class="text-green-700 text-xs font-medium mb-1">Penjualan</p>
                                <p class="text-lg font-bold text-green-900">Rp 35jt</p>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-red-50 to-red-100 rounded-xl border border-red-200">
                                <p class="text-red-700 text-xs font-medium mb-1">Pengeluaran</p>
                                <p class="text-lg font-bold text-red-900">Rp 15jt</p>
                            </div>
                        </div>

                        <div class="h-64">
                            <canvas id="chartCashflow"></canvas>
                        </div>
                    </div>

                    <!-- GRAFIK PERBANDINGAN -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">Pengeluaran vs Pendapatan</h3>
                            <p class="text-sm text-gray-600">Perbandingan 5 bulan</p>
                        </div>

                        <div class="mb-4">
                            <div class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                                <p class="text-blue-700 text-sm font-medium mb-1">Profit Margin</p>
                                <div class="flex items-baseline gap-2">
                                    <p class="text-2xl font-bold text-blue-900">57%</p>
                                    <span class="text-xs text-green-600">↑ 5% vs bulan lalu</span>
                                </div>
                            </div>
                        </div>

                        <div class="h-64">
                            <canvas id="chartComparation"></canvas>
                        </div>
                    </div>

                </div>

            </main>

            <!-- FOOTER -->
@include('components.footer')

        </div>

    </div>

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

        // --- GRAFIK CASHFLOW (LINE) ---
        const ctxCashflow = document.getElementById('chartCashflow').getContext('2d');
        new Chart(ctxCashflow, {
            type: 'line',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni"],
                datasets: [
                    {
                        label: "Penjualan",
                        data: [20000000, 25000000, 22000000, 30000000, 32000000, 35000000],
                        borderColor: "#10b981",
                        backgroundColor: "rgba(16,185,129,0.15)",
                        borderWidth: 3,
                        fill: true,
                        tension: 0.35,
                        pointRadius: 5,
                        pointBackgroundColor: "#10b981",
                        pointHoverRadius: 7,
                        pointBorderWidth: 2,
                        pointBorderColor: '#fff'
                    },
                    {
                        label: "Pengeluaran",
                        data: [12000000, 14000000, 13000000, 15000000, 16000000, 15000000],
                        borderColor: "#ef4444",
                        backgroundColor: "rgba(239,68,68,0.15)",
                        borderWidth: 3,
                        fill: true,
                        tension: 0.35,
                        pointRadius: 5,
                        pointBackgroundColor: "#ef4444",
                        pointHoverRadius: 7,
                        pointBorderWidth: 2,
                        pointBorderColor: '#fff'
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
                        cornerRadius: 8,
                        titleFont: { size: 14, family: 'Inter' },
                        bodyFont: { size: 13, family: 'Inter' },
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    },
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: { size: 12, family: 'Inter' },
                            padding: 15,
                            boxWidth: 12,
                            boxHeight: 12,
                            usePointStyle: true
                        }
                    }
                },
                scales: {
                    y: {
                        grid: { drawBorder: false, color: 'rgba(0, 0, 0, 0.05)' },
                        ticks: {
                            font: { size: 11, family: 'Inter' },
                            callback: value => 'Rp ' + (value / 1000000) + 'jt'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11, family: 'Inter' } }
                    }
                }
            }
        });

        // --- GRAFIK PERBANDINGAN (BAR) ---
        const ctxComparation = document.getElementById('chartComparation').getContext('2d');
        new Chart(ctxComparation, {
            type: 'bar',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei"],
                datasets: [
                    {
                        label: "Pengeluaran",
                        data: [1200000, 1500000, 1300000, 1400000, 1600000],
                        backgroundColor: "rgba(239,68,68,0.8)",
                        borderColor: "#ef4444",
                        borderWidth: 2,
                        borderRadius: 8,
                        barPercentage: 0.7
                    },
                    {
                        label: "Penjualan",
                        data: [2400000, 2600000, 2500000, 3000000, 3500000],
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
                        cornerRadius: 8,
                        titleFont: { size: 14, family: 'Inter' },
                        bodyFont: { size: 13, family: 'Inter' },
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    },
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: { size: 12, family: 'Inter' },
                            padding: 15,
                            boxWidth: 12,
                            boxHeight: 12,
                            usePointStyle: true
                        }
                    }
                },
                scales: {
                    y: {
                        grid: { drawBorder: false, color: 'rgba(0, 0, 0, 0.05)' },
                        ticks: {
                            font: { size: 11, family: 'Inter' },
                            callback: value => 'Rp ' + (value / 1000000) + 'jt'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11, family: 'Inter' } }
                    }
                }
            }
        });
    </script>
@endsection
