<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    @vite('resources/css/app.css')

    <!-- Icons & Libraries -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: true }">

    <!-- Layout -->
    <div class="min-h-screen flex">

        <!-- SIDEBAR -->
        <aside
            class="bg-white shadow-md border-r w-64 transform transition-all duration-300 ease-in-out z-50
                   fixed md:static inset-y-0 left-0
                   "
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'">

            <div class="p-6 border-b flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-700">🐔 Manajemen Telur</h1>

                <!-- Close button (Mobile Only) -->
                <button @click="sidebarOpen = false" class="md:hidden">
                    <i data-feather="x"></i>
                </button>
            </div>

            <nav class="p-4 space-y-2">

                <!-- ACTIVE MENU -->
                <a href="/dashboard"
                    class="flex items-center gap-3 px-2 py-2 rounded-lg bg-yellow-400 font-semibold text-gray-900">
                    <i data-feather="layout"></i>
                    Dashboard
                </a>

                <a href="/managemenkandang"
                    class="flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
                    <i data-feather="home"></i>
                    Manajemen Kandang
                </a>

                <a href="/managementelur"
                    class="flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
                    <i data-feather="package"></i>
                    Manajemen Telur
                </a>

                <a href="/managemenpenjualan"
                    class="flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
                    <i data-feather="shopping-bag"></i>
                    Manajemen Penjualan
                </a>

                <a href="/managemenpengeluaran"
                    class="flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
                    <i data-feather="shopping-cart"></i>
                    Manajemen Pengeluaran
                </a>

                <a href="/pembukuan"
                    class="flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
                    <i data-feather="file-text"></i>
                    Pembukuan
                </a>

                <a href="/pengaturan"
                    class="flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
                    <i data-feather="settings"></i>
                    Pengaturan
                </a>

            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 ml-0 transition-all duration-300">

            <!-- HEADER (Toggle + Admin Button) -->
            <div class="flex items-center justify-between mb-6" x-data="{ open: false }">

                <!-- Toggle Sidebar Button -->
                <button @click="sidebarOpen = !sidebarOpen"
                    class="bg-white px-4 py-2 shadow rounded-lg border hover:bg-gray-100 transition flex items-center gap-2">
                    <i data-feather="menu"></i>
                </button>

                <!-- Admin Button -->
                <div class="relative">

                    <button @click="open = !open"
                        class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow border border-gray-100 hover:shadow-md transition">
                        <i data-feather="user"></i>
                        <span class="text-gray-700 font-medium">Admin</span>
                        <i data-feather="chevron-down" class="w-4 h-4"></i>
                    </button>

                    <!-- Dropdown -->
                    <div x-cloak x-show="open" @click.outside="open = false" x-transition
                        class="absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg border border-gray-200 z-50 overflow-hidden">
                        <a href="#"
                            class="flex items-center gap-2 px-4 py-3 hover:bg-gray-100 text-gray-700 text-sm">
                            <i data-feather="user"></i> Profil
                        </a>

                        <form>
                            @csrf
                            <button
                                class="w-full flex items-center gap-2 px-4 py-3 text-left hover:bg-red-50 text-red-600 text-sm">
                                <i data-feather="log-out"></i> Logout
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            <!-- TITLE -->
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Dashboard</h2>

            <!-- CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white p-6 rounded-xl shadow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Total Telur Hari Ini</h3>
                        <i data-feather="egg"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">380</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Total Penjualan</h3>
                        <i data-feather="shopping-cart"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">Rp 1.250.000</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Saldo Bersih</h3>
                        <i data-feather="credit-card"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">Rp 840.000</p>
                </div>
            </div>

            <!-- GRAFIK -->
            <div class="bg-white mt-8 p-6 rounded-xl shadow">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Grafik Produksi Telur (7 Hari Terakhir)</h3>
                <canvas id="eggChart" height="110"></canvas>
            </div>

            <!-- PEMBUKUAN & LAPORAN -->
            <div class="bg-white mt-8 p-6 rounded-xl shadow">
                <h3 class="text-xl font-semibold text-gray-700 mb-6">
                    Pembukuan & Laporan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- RINGKASAN KEUANGAN -->
                    <div class="p-5 rounded-xl border bg-white shadow-sm hover:shadow-md transition">
                        <p class="text-gray-500 text-sm mb-1">Ringkasan Keuangan</p>
                        <h4 class="text-3xl font-bold text-gray-800 mb-1">Rp 10.000.000</h4>
                        <p class="text-green-600 text-sm mb-3">Bulan ini +15%</p>

                        <canvas id="chartRingkasan" height="100"></canvas>
                    </div>

                    <!-- SALDO -->
                    <div class="p-5 rounded-xl border bg-white shadow-sm hover:shadow-md transition">
                        <p class="text-gray-500 text-sm mb-1">Saldo</p>
                        <h4 class="text-3xl font-bold text-gray-800 mb-1">Rp 5.000.000</h4>
                        <p class="text-green-600 text-sm mb-3">Bulan ini +10%</p>

                        <canvas id="chartSaldo" height="100"></canvas>
                    </div>

                    <!-- PENJUALAN -->
                    <div class="p-5 rounded-xl border bg-white shadow-sm hover:shadow-md transition">
                        <p class="text-gray-500 text-sm mb-1">Grafik Penjualan</p>
                        <h4 class="text-3xl font-bold text-gray-800 mb-1">Rp 7.500.000</h4>
                        <p class="text-green-600 text-sm mb-3">Bulan ini +12%</p>

                        <canvas id="chartPenjualan" height="100"></canvas>
                    </div>

                    <!-- PENGELUARAN -->
                    <div class="p-5 rounded-xl border bg-white shadow-sm hover:shadow-md transition">
                        <p class="text-gray-500 text-sm mb-1">Grafik Pengeluaran</p>
                        <h4 class="text-3xl font-bold text-gray-800 mb-1">Rp 3.200.000</h4>
                        <p class="text-red-600 text-sm mb-3">Bulan ini +8%</p>

                        <canvas id="chartPengeluaran" height="100"></canvas>
                    </div>


                </div>
            </div>


            <!-- AKTIVITAS -->
            <div class="bg-white mt-8 p-6 rounded-xl shadow">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Aktivitas Terbaru</h3>

                <ul class="space-y-3">
                    <li class="flex items-center justify-between border-b pb-3">
                        <span>Menambah telur pada Kandang 1</span>
                        <span class="text-sm text-gray-500">10 menit lalu</span>
                    </li>
                    <li class="flex items-center justify-between border-b pb-3">
                        <span>Penjualan 60 butir</span>
                        <span class="text-sm text-gray-500">1 jam lalu</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span>Input pakan baru 20kg</span>
                        <span class="text-sm text-gray-500">2 jam lalu</span>
                    </li>
                </ul>
            </div>

        </main>
    </div>

    <!-- SCRIPTS -->
    <script>
        feather.replace();

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
                    backgroundColor: 'rgba(251, 191, 36, 0.3)',
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false
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
                    tension: 0.3
                }]
            },
            options: {
                responsive: true
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
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true
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
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true
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
                    tension: 0.3
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

</body>

</html>
