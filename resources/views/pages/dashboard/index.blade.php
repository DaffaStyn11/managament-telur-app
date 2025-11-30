@extends("layouts.app")
@section("content")
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
        @include("components.sidebar")

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col min-h-screen w-full transition-all duration-300 ease-in-out"
            :style="!isMobile() && sidebarOpen ? 'margin-left: 288px' : 'margin-left: 0'">

            <!-- HEADER -->
            @include("components.header")

            <!-- CONTENT AREA -->
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 lg:py-8 bg-gray-50">

                <!-- TITLE -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Dashboard</h2>
                    <p class="text-gray-600">Selamat datang kembali! Berikut ringkasan performa peternakan Anda hari ini.
                    </p>
                </div>

                <!-- SUMMARY CARDS -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i data-feather="egg" class="w-6 h-6 text-blue-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Total Telur Hari Ini</h3>
                        <p class="text-3xl font-bold text-gray-900">380</p>
                        <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                            <span>↑ 12%</span> vs kemarin
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <i data-feather="shopping-cart" class="w-6 h-6 text-green-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Total Penjualan</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp 1,25 Jt</p>
                        <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                            <span>↑ 8%</span> dari target
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                <i data-feather="credit-card" class="w-6 h-6 text-purple-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Saldo Bersih</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp 840 K</p>
                        <p class="text-xs text-gray-500 mt-2">saldo tersedia</p>
                    </div>

                </div>
                <!-- GRAFIK PRODUKSI -->
                {{-- <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 mb-8">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Grafik Produksi Telur</h3>
                        <p class="text-sm text-gray-600">7 hari terakhir</p>
                    </div>
                    <canvas id="eggChart" height="80"></canvas>
                </div> --}}

                <!-- PEMBUKUAN & LAPORAN -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 mb-8">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Pembukuan & Laporan</h3>
                        <p class="text-sm text-gray-600">Ringkasan keuangan bulan ini</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <!-- RINGKASAN KEUANGAN -->
                        <div
                            class="p-6 rounded-xl border border-gray-200 bg-gradient-to-br from-blue-50 to-white hover:shadow-md transition">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-gray-600 text-sm mb-1">Ringkasan Keuangan</p>
                                    <h4 class="text-3xl font-bold text-gray-900">Rp 10 Jt</h4>
                                </div>
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <i data-feather="trending-up" class="w-6 h-6 text-blue-600"></i>
                                </div>
                            </div>
                            <p class="text-green-600 text-sm mb-4 flex items-center gap-1">
                                <span>↑ 15%</span> bulan ini
                            </p>
                            <canvas id="chartRingkasan" height="100"></canvas>
                        </div>

                        <!-- SALDO -->
                        <div
                            class="p-6 rounded-xl border border-gray-200 bg-gradient-to-br from-green-50 to-white hover:shadow-md transition">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-gray-600 text-sm mb-1">Saldo</p>
                                    <h4 class="text-3xl font-bold text-gray-900">Rp 5 Jt</h4>
                                </div>
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                    <i data-feather="dollar-sign" class="w-6 h-6 text-green-600"></i>
                                </div>
                            </div>
                            <p class="text-green-600 text-sm mb-4 flex items-center gap-1">
                                <span>↑ 10%</span> bulan ini
                            </p>
                            <canvas id="chartSaldo" height="100"></canvas>
                        </div>

                        <!-- PENJUALAN -->
                        <div
                            class="p-6 rounded-xl border border-gray-200 bg-gradient-to-br from-purple-50 to-white hover:shadow-md transition">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-gray-600 text-sm mb-1">Grafik Penjualan</p>
                                    <h4 class="text-3xl font-bold text-gray-900">Rp 7,5 Jt</h4>
                                </div>
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <i data-feather="shopping-bag" class="w-6 h-6 text-purple-600"></i>
                                </div>
                            </div>
                            <p class="text-green-600 text-sm mb-4 flex items-center gap-1">
                                <span>↑ 12%</span> bulan ini
                            </p>
                            <canvas id="chartPenjualan" height="100"></canvas>
                        </div>

                        <!-- PENGELUARAN -->
                        <div
                            class="p-6 rounded-xl border border-gray-200 bg-gradient-to-br from-orange-50 to-white hover:shadow-md transition">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-gray-600 text-sm mb-1">Grafik Pengeluaran</p>
                                    <h4 class="text-3xl font-bold text-gray-900">Rp 3,2 Jt</h4>
                                </div>
                                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                                    <i data-feather="trending-down" class="w-6 h-6 text-orange-600"></i>
                                </div>
                            </div>
                            <p class="text-red-600 text-sm mb-4 flex items-center gap-1">
                                <span>↑ 8%</span> bulan ini
                            </p>
                            <canvas id="chartPengeluaran" height="100"></canvas>
                        </div>

                    </div>
                </div>

                <!-- AKTIVITAS -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Aktivitas Terbaru</h3>
                        <p class="text-sm text-gray-600">Log aktivitas sistem hari ini</p>
                    </div>

                    <div class="space-y-4">
                        <div
                            class="flex items-start gap-4 p-4 rounded-xl border border-gray-200 hover:bg-gray-50 transition">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i data-feather="plus-circle" class="w-5 h-5 text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-900 font-medium text-sm">Menambah telur pada Kandang 1</p>
                                <p class="text-xs text-gray-500 mt-1">10 menit lalu</p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-4 p-4 rounded-xl border border-gray-200 hover:bg-gray-50 transition">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i data-feather="shopping-cart" class="w-5 h-5 text-green-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-900 font-medium text-sm">Penjualan 60 butir</p>
                                <p class="text-xs text-gray-500 mt-1">1 jam lalu</p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-4 p-4 rounded-xl border border-gray-200 hover:bg-gray-50 transition">
                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i data-feather="package" class="w-5 h-5 text-orange-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-900 font-medium text-sm">Input pakan baru 20kg</p>
                                <p class="text-xs text-gray-500 mt-1">2 jam lalu</p>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

            @include("components.footer")

        </div>

    </div>
    @include("components.scripts")
        <script>
        feather.replace();

        // Update feather icons when Alpine re-renders
        document.addEventListener('alpine:initialized', () => {
            setTimeout(() => feather.replace(), 100);
        });

        // Chart Produksi Telur
        const ctx = document.getElementById('eggChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Produksi Telur',
                    data: [320, 340, 300, 380, 360, 390, 410],
                    borderWidth: 3,
                    borderColor: '#FBBF24',
                    backgroundColor: 'rgba(251, 191, 36, 0.2)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#FBBF24',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 12,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#374151',
                        borderWidth: 1,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Chart Ringkasan Keuangan
        new Chart(document.getElementById('chartRingkasan'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Pendapatan',
                    data: [5000, 7000, 6000, 8000, 9500, 10000],
                    borderWidth: 2,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Chart Saldo
        new Chart(document.getElementById('chartSaldo'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Saldo',
                    data: [2000, 2500, 3000, 3500, 4000, 5000],
                    backgroundColor: '#10b981',
                    borderRadius: 8,
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Chart Penjualan
        new Chart(document.getElementById('chartPenjualan'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Penjualan',
                    data: [4000, 4500, 5000, 5500, 7000, 7500],
                    backgroundColor: '#8b5cf6',
                    borderRadius: 8,
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Chart Pengeluaran
        new Chart(document.getElementById('chartPengeluaran'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Pengeluaran',
                    data: [1500, 1800, 1700, 2000, 2500, 3200],
                    borderWidth: 2,
                    borderColor: '#f97316',
                    backgroundColor: 'rgba(249, 115, 22, 0.1)',
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#f97316',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>

@endsection
