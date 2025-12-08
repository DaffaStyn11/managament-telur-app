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
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Pembukuan</h2>
                    <p class="text-gray-600">Ringkasan keuangan dan laporan lengkap peternakan Anda.</p>
                </div>

                <!-- Toolbar -->
                <div class="mb-6 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">

                    <!-- Search -->
                    <form method="GET" action="{{ route('pembukuan.index') }}" class="relative w-full lg:max-w-md">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">
                            search
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full h-12 pl-12 pr-20 rounded-xl border border-gray-300 bg-white
                                      focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition text-sm"
                            placeholder="Cari periode bulan...">
                        @if (request('search'))
                            <a href="{{ route('pembukuan.index') }}"
                                class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-gray-600 transition"
                                title="Clear search">
                                <i data-feather="x" class="w-4 h-4"></i>
                            </a>
                        @endif
                    </form>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3 flex-wrap w-full lg:w-auto">

                        <a href="{{ route('pembukuan.export.excel') }}"
                            class="flex h-12 items-center gap-2 rounded-xl border border-gray-300 px-4 text-sm font-semibold
                           bg-white hover:bg-gray-50 transition shadow-sm flex-1 lg:flex-none justify-center">
                            <span class="material-symbols-outlined text-xl text-green-600">grid_on</span>
                            <span class="hidden sm:inline">Excel</span>
                        </a>

                        <a href="{{ route('pembukuan.export.pdf') }}"
                            class="flex h-12 items-center gap-2 rounded-xl border border-gray-300 px-4 text-sm font-semibold
                           bg-white hover:bg-gray-50 transition shadow-sm flex-1 lg:flex-none justify-center">
                            <span class="material-symbols-outlined text-xl text-red-600">picture_as_pdf</span>
                            <span class="hidden sm:inline">PDF</span>
                        </a>

                    </div>
                </div>

                <!-- CARD SUMMARY -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                                <i data-feather="trending-down" class="w-6 h-6 text-red-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Total Pengeluaran</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i data-feather="trending-up" class="w-6 h-6 text-blue-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Total Penjualan</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <i data-feather="dollar-sign" class="w-6 h-6 text-green-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Saldo Akhir</h3>
                        <p class="text-3xl font-bold text-green-600">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</p>
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
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        No</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Periode</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Deskripsi</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Penjualan</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Pengeluaran</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                        Saldo</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @php $no = 1; @endphp
                                @forelse($monthlyData as $index => $data)
                                    <!-- Penjualan Row -->
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm text-gray-900 font-medium" rowspan="3">
                                            {{ $no }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700" rowspan="3">{{ $data['month_name'] }}
                                            {{ now()->year }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">Penjualan</td>
                                        <td class="px-6 py-4 text-sm font-semibold text-green-600">Rp
                                            {{ number_format($data['penjualan'], 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">-</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                + Rp {{ number_format($data['penjualan'], 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                    <!-- Pengeluaran Row -->
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm text-gray-700">Pengeluaran</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">-</td>
                                        <td class="px-6 py-4 text-sm font-semibold text-red-600">Rp
                                            {{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                                - Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                    <!-- Saldo Row -->
                                    <tr class="bg-gray-50 font-semibold">
                                        <td class="px-6 py-4 text-sm text-gray-900">Saldo</td>
                                        <td class="px-6 py-4 text-sm text-green-600">Rp
                                            {{ number_format($data['penjualan'], 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm text-red-600">Rp
                                            {{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold {{ $data['saldo'] >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                Rp {{ number_format($data['saldo'], 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @php $no++; @endphp
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <i data-feather="inbox" class="w-16 h-16 text-gray-300 mb-4"></i>
                                                <p class="text-gray-500 text-lg font-medium mb-2">Belum ada data pembukuan
                                                </p>
                                                <p class="text-gray-400 text-sm">Data akan muncul setelah ada transaksi
                                                    penjualan atau pengeluaran</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
                            <div
                                class="p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl border border-green-200">
                                <p class="text-green-700 text-xs font-medium mb-1">Penjualan</p>
                                <p class="text-lg font-bold text-green-900">Rp
                                    {{ number_format($latestMonthPenjualan) }}</p>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-red-50 to-red-100 rounded-xl border border-red-200">
                                <p class="text-red-700 text-xs font-medium mb-1">Pengeluaran</p>
                                <p class="text-lg font-bold text-red-900">Rp
                                    {{ number_format($latestMonthPengeluaran) }}</p>
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
                                <p class="text-blue-700 text-sm font-medium mb-1">Saldo Bulan Terakhir</p>
                                <div class="flex items-baseline gap-2">
                                    <p class="text-2xl font-bold text-blue-900">Rp
                                        {{ number_format($latestMonthPenjualan - $latestMonthPengeluaran) }}
                                    </p>
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
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                        label: "Penjualan",
                        data: {!! json_encode($chartPenjualan) !!},
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
                        data: {!! json_encode($chartPengeluaran) !!},
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
                                return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString(
                                    'id-ID');
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
                            usePointStyle: true
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
                            callback: value => 'Rp ' + (value / 1000000) + 'jt'
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

        // --- GRAFIK PERBANDINGAN (BAR) ---
        const ctxComparation = document.getElementById('chartComparation').getContext('2d');
        new Chart(ctxComparation, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_slice($chartLabels, -5)) !!},
                datasets: [{
                        label: "Pengeluaran",
                        data: {!! json_encode(array_slice($chartPengeluaran, -5)) !!},
                        backgroundColor: "rgba(239,68,68,0.8)",
                        borderColor: "#ef4444",
                        borderWidth: 2,
                        borderRadius: 8,
                        barPercentage: 0.7
                    },
                    {
                        label: "Penjualan",
                        data: {!! json_encode(array_slice($chartPenjualan, -5)) !!},
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
                                return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString(
                                    'id-ID');
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
                            usePointStyle: true
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
                            callback: value => 'Rp ' + (value / 1000000) + 'jt'
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
