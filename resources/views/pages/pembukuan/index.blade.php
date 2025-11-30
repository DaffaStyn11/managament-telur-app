<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembukuan</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        * {
            transition-property: background-color, border-color, color, fill, stroke;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
    </style>
</head>

<body class="bg-gray-50 antialiased" x-data="{
    sidebarOpen: window.innerWidth >= 768,
    isMobile() { return window.innerWidth < 768; }
}" x-init="window.addEventListener('resize', () => { if (window.innerWidth >= 768) { sidebarOpen = true; } })">

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
        <aside
            class="bg-white shadow-xl border-r border-gray-200 w-72 transform transition-transform duration-300 ease-in-out z-50
                   fixed inset-y-0 left-0 h-screen"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full">

            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-2xl">🐔</span>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-gray-900">Farm Manager</h1>
                            <p class="text-xs text-gray-500">Sistem Manajemen</p>
                        </div>
                    </div>

                    <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-gray-600">
                        <i data-feather="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-88px)]">

                <a href="/dashboard" @click="if(isMobile()) sidebarOpen = false"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-gray-900 group">
                    <i data-feather="layout" class="w-5 h-5 text-gray-400 group-hover:text-gray-600"></i>
                    <span class="font-medium text-sm">Dashboard</span>
                </a>

                <a href="/managemenkandang" @click="if(isMobile()) sidebarOpen = false"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-gray-900 group">
                    <i data-feather="home" class="w-5 h-5 text-gray-400 group-hover:text-gray-600"></i>
                    <span class="font-medium text-sm">Manajemen Kandang</span>
                </a>

                <a href="/managementelur" @click="if(isMobile()) sidebarOpen = false"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-gray-900 group">
                    <i data-feather="package" class="w-5 h-5 text-gray-400 group-hover:text-gray-600"></i>
                    <span class="font-medium text-sm">Manajemen Telur</span>
                </a>

                <a href="/managemenpenjualan" @click="if(isMobile()) sidebarOpen = false"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-gray-900 group">
                    <i data-feather="shopping-bag" class="w-5 h-5 text-gray-400 group-hover:text-gray-600"></i>
                    <span class="font-medium text-sm">Manajemen Penjualan</span>
                </a>

                <a href="/managemenpengeluaran" @click="if(isMobile()) sidebarOpen = false"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-gray-900 group">
                    <i data-feather="shopping-cart" class="w-5 h-5 text-gray-400 group-hover:text-gray-600"></i>
                    <span class="font-medium text-sm">Manajemen Pengeluaran</span>
                </a>

                <!-- ACTIVE PAGE -->
                <a href="/pembukuan" @click="if(isMobile()) sidebarOpen = false"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 shadow-md">
                    <i data-feather="file-text" class="w-5 h-5"></i>
                    <span class="font-semibold text-sm">Pembukuan</span>
                </a>

                <div class="my-4 border-t border-gray-200"></div>

                <a href="/pengaturan" @click="if(isMobile()) sidebarOpen = false"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-gray-900 group">
                    <i data-feather="settings" class="w-5 h-5 text-gray-400 group-hover:text-gray-600"></i>
                    <span class="font-medium text-sm">Pengaturan</span>
                </a>

            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col min-h-screen w-full transition-all duration-300 ease-in-out"
             :style="!isMobile() && sidebarOpen ? 'margin-left: 288px' : 'margin-left: 0'">

            <!-- TOPBAR -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-30 shadow-sm">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">

                        <!-- Toggle Sidebar -->
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-600 border border-gray-200">
                            <i data-feather="menu" class="w-5 h-5"></i>
                        </button>

                        <!-- Admin Button -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center gap-3 bg-gray-50 px-4 py-2.5 rounded-xl border border-gray-200 hover:bg-gray-100 hover:border-gray-300">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <i data-feather="user" class="w-4 h-4 text-white"></i>
                                </div>
                                <span class="text-gray-700 font-semibold text-sm hidden sm:block">Admin</span>
                                <i data-feather="chevron-down" class="w-4 h-4 text-gray-400"></i>
                            </button>

                            <!-- Dropdown -->
                            <div x-cloak x-show="open" @click.outside="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 overflow-hidden">

                                <div class="p-3 border-b border-gray-100">
                                    <p class="text-xs text-gray-500">Masuk sebagai</p>
                                    <p class="font-semibold text-gray-900 text-sm">Administrator</p>
                                </div>

                                <a href="#"
                                    class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 text-gray-700 text-sm">
                                    <i data-feather="user" class="w-4 h-4"></i>
                                    <span>Profil Saya</span>
                                </a>

                                <div class="border-t border-gray-100"></div>

                                <form method="POST" class="p-2">
                                    <button type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 text-red-600 text-sm font-medium">
                                        <i data-feather="log-out" class="w-4 h-4"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

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
            <footer class="bg-white border-t border-gray-200 py-6 px-4 sm:px-6 lg:px-8">
                <div class="text-center text-sm text-gray-600">
                    © 2025 Farm Manager. Sistem Manajemen Peternakan Modern.
                </div>
            </footer>

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

</body>

</html>
