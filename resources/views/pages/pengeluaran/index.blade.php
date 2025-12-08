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
                    <form method="GET" action="{{ route('pengeluaran.index') }}" class="relative w-full lg:max-w-md">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">
                            search
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full h-12 pl-12 pr-20 rounded-xl border border-gray-300 bg-white
                                      focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition text-sm"
                            placeholder="Cari tanggal, kuantitas...">
                        @if (request('search'))
                            <a href="{{ route('pengeluaran.index') }}"
                                class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-gray-600 transition"
                                title="Clear search">
                                <i data-feather="x" class="w-4 h-4"></i>
                            </a>
                        @endif
                    </form>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3 flex-wrap w-full lg:w-auto">

                        <a href="{{ route('pengeluaran.export.excel') }}"
                            class="flex h-12 items-center gap-2 rounded-xl border border-gray-300 px-4 text-sm font-semibold
                           bg-white hover:bg-gray-50 transition shadow-sm flex-1 lg:flex-none justify-center">
                            <span class="material-symbols-outlined text-xl text-green-600">grid_on</span>
                            <span class="hidden sm:inline">Excel</span>
                        </a>

                        <a href="{{ route('pengeluaran.export.pdf') }}"
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
                                <i data-feather="credit-card" class="w-6 h-6 text-red-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Pengeluaran Hari Ini</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($stats['today'], 0, ',', '.') }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                                <i data-feather="trending-down" class="w-6 h-6 text-orange-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Pengeluaran Mingguan</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp
                            {{ number_format($stats['weekly_avg'], 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-2">7 hari terakhir</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                <i data-feather="calendar" class="w-6 h-6 text-purple-600"></i>
                            </div>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium mb-1">Pengeluaran Bulanan</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($stats['monthly'], 0, ',', '.') }}
                        </p>
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

                            <button @click="$dispatch('open-create-modal')"
                                class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 rounded-xl shadow-md hover:shadow-lg font-semibold flex items-center justify-center gap-2 transition">
                                <i data-feather="plus" class="w-5 h-5"></i>
                                <span>Tambah Pengeluaran</span>
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
                                @forelse($pengeluarans as $index => $pengeluaran)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                            {{ $pengeluarans->firstItem() + $index }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $pengeluaran->tanggal->format('d M Y') }}</td>
                                        <td class="px-6 py-4">
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900">
                                                    {{ $pengeluaran->nama_barang }}</p>
                                                @if ($pengeluaran->kategori)
                                                    <p class="text-xs text-gray-500">{{ $pengeluaran->kategori }}</p>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="text-sm font-semibold text-gray-900">{{ number_format($pengeluaran->jumlah) }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">Rp
                                            {{ number_format($pengeluaran->harga_satuan, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp
                                            {{ number_format($pengeluaran->total, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <button
                                                    @click="$dispatch('open-edit-modal', { id: {{ $pengeluaran->id }}, tanggal: '{{ $pengeluaran->tanggal->format('Y-m-d') }}', nama_barang: '{{ $pengeluaran->nama_barang }}', kategori: '{{ $pengeluaran->kategori }}', jumlah: {{ $pengeluaran->jumlah }}, harga_satuan: {{ $pengeluaran->harga_satuan }}, catatan: '{{ $pengeluaran->catatan }}' })"
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                                    title="Edit">
                                                    <i data-feather="edit-3" class="w-4 h-4"></i>
                                                </button>
                                                <form action="{{ route('pengeluaran.destroy', $pengeluaran->id) }}"
                                                    method="POST" class="inline"
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
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <i data-feather="inbox" class="w-16 h-16 text-gray-300 mb-4"></i>
                                                <p class="text-gray-500 text-lg font-medium mb-2">Belum ada data
                                                    pengeluaran</p>
                                                <p class="text-gray-400 text-sm mb-4">Silakan tambahkan data pengeluaran
                                                </p>
                                                <button @click="$dispatch('open-create-modal')"
                                                    class="px-6 py-2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 rounded-lg font-semibold hover:shadow-md transition">
                                                    Tambah Pengeluaran
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($pengeluarans->hasPages())
                        <div
                            class="flex flex-col sm:flex-row items-center justify-between px-6 py-4 border-t border-gray-200 gap-4">
                            <span class="text-sm text-gray-600">
                                Menampilkan <span class="font-semibold">{{ $pengeluarans->firstItem() }}</span> -
                                <span class="font-semibold">{{ $pengeluarans->lastItem() }}</span> dari
                                <span class="font-semibold">{{ $pengeluarans->total() }}</span> entri
                            </span>

                            <div class="flex items-center gap-2">
                                {{ $pengeluarans->links() }}
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
    @include('pages.pengeluaran.create')

    <!-- EDIT MODAL -->
    @include('pages.pengeluaran.edit')

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
