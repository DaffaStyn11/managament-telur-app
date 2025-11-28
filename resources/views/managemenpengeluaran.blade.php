<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengeluaran</title>

    @vite('resources/css/app.css')

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">

    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: true }">

    <div class="min-h-screen flex">

        <!-- SIDEBAR -->
        <aside
            class="bg-white shadow-md border-r w-64 transform transition-all duration-300 ease-in-out z-50
                   fixed md:static inset-y-0 left-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'">

            <div class="p-6 border-b flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-700">🐔 Manajemen Telur</h1>

                <button @click="sidebarOpen = false" class="md:hidden">
                    <i data-feather="x"></i>
                </button>
            </div>

            <nav class="p-4 space-y-2">

                <a href="/dashboard"
                    class="flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
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

                <!-- ACTIVE -->
                <a href="/managemenpengeluaran"
                    class="flex items-center gap-3 px-2 py-2 rounded-lg bg-yellow-400 text-gray-900 font-semibold">
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

            <!-- TOPBAR -->
            <div class="flex items-center justify-between mb-6" x-data="{ open: false }">

                <!-- Toggle Sidebar -->
                <button @click="sidebarOpen = !sidebarOpen"
                    class="bg-white px-4 py-2 shadow rounded-lg border hover:bg-gray-100 transition flex items-center gap-2">
                    <i data-feather="menu"></i>
                </button>

                <!-- Admin Dropdown -->
                <div class="relative">
                    <button @click="open = !open"
                        class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow border border-gray-100 hover:shadow-md transition">
                        <i data-feather="user"></i>
                        <span class="text-gray-700 font-medium">Admin</span>
                        <i data-feather="chevron-down" class="w-4 h-4"></i>
                    </button>

                    <div x-cloak x-show="open" @click.outside="open = false" x-transition
                        class="absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg border border-gray-200 z-50 overflow-hidden">
                        <a href="#"
                            class="flex items-center gap-2 px-4 py-3 hover:bg-gray-100 text-gray-700 text-sm">
                            <i data-feather="user"></i> Profil
                        </a>

                        <form method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-2 px-4 py-3 text-left hover:bg-red-50 text-red-600 text-sm">
                                <i data-feather="log-out"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- TITLE -->
            <div class="flex flex-col gap-1 mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Manajemen Pengeluaran</h2>
                <p class="text-gray-600 text-sm">Kelola semua pengeluaran Anda.</p>
            </div>

            <!-- TOOLBAR -->
            <div class="mb-4 flex flex-col md:flex-row justify-between items-center gap-4">

                <!-- Search -->
                <div class="relative flex-1 md:max-w-xs">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">
                        search
                    </span>
                    <input type="text"
                        class="w-full h-10 pl-11 pr-4 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-yellow-400 transition"
                        placeholder="Cari pengeluaran...">
                </div>

                <div class="flex items-center gap-2 flex-wrap">

                    <button
                        class="flex h-10 items-center gap-2 rounded-lg border border-gray-300 px-4 text-sm font-semibold bg-white hover:bg-gray-100 transition shadow-sm">
                        <span class="material-symbols-outlined text-lg text-gray-600">calendar_month</span>
                        Filter Tanggal
                    </button>

                    <button
                        class="flex h-10 items-center gap-2 rounded-lg border border-gray-300 px-4 text-sm font-semibold bg-white hover:bg-gray-100 transition shadow-sm">
                        <span class="material-symbols-outlined text-lg text-green-500">grid_on</span>
                        Cetak Excel
                    </button>

                    <button
                        class="flex h-10 items-center gap-2 rounded-lg border border-gray-300 px-4 text-sm font-semibold bg-white hover:bg-gray-100 transition shadow-sm">
                        <span class="material-symbols-outlined text-lg text-red-500">picture_as_pdf</span>
                        Cetak PDF
                    </button>

                </div>
            </div>

            <!-- CARD SUMMARY -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                <div class="bg-white p-6 rounded-xl shadow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Total Pengeluaran Hari Ini</h3>
                        <i data-feather="credit-card"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">Rp 750.000</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Pengeluaran Mingguan</h3>
                        <i data-feather="trending-down"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">Rp 4.500.000</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Pengeluaran Bulanan</h3>
                        <i data-feather="calendar"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">Rp 18.000.000</p>
                </div>

            </div>

            <!-- TABLE -->
            <div class="bg-white p-6 rounded-xl shadow">

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Daftar Pengeluaran</h3>

                    <a href="#"
                        class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg shadow hover:bg-yellow-500 font-semibold flex items-center gap-2">
                        <i data-feather="plus"></i>
                        Tambah Pengeluaran
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Deskripsi/Nama Barang</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Harga Satuan</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Total Biaya</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">1</td>
                                <td class="p-3">27 Nov 2025</td>
                                <td class="p-3">Obat</td>
                                <td class="p-3">Vitamin VitaStress</td>
                                <td class="p-3">2 botol</td>
                                <td class="p-3">Rp 25.000</td>
                                <td class="p-3 font-semibold">Rp 50.000</td>
                                <td class="p-3 flex gap-3">
                                    <button class="text-blue-600 hover:text-blue-800">
                                        <i data-feather="edit-3"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">2</td>
                                <td class="p-3">27 Nov 2025</td>
                                <td class="p-3">Pakan</td>
                                <td class="p-3">Pakan Konsentrat CP-11</td>
                                <td class="p-3">50 kg</td>
                                <td class="p-3">Rp 9.500</td>
                                <td class="p-3 font-semibold">Rp 475.000</td>
                                <td class="p-3 flex gap-3">
                                    <button class="text-blue-600 hover:text-blue-800">
                                        <i data-feather="edit-3"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50">
                                <td class="p-3">3</td>
                                <td class="p-3">27 Nov 2025</td>
                                <td class="p-3">Ayam</td>
                                <td class="p-3">Golden Red</td>
                                <td class="p-3">10</td>
                                <td class="p-3">Rp 95.000</td>
                                <td class="p-3 font-semibold">Rp 950.000</td>
                                <td class="p-3 flex gap-3">
                                    <button class="text-blue-600 hover:text-blue-800">
                                        <i data-feather="edit-3"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between border-t px-6 py-3">
                    <span class="text-sm text-gray-600">Menampilkan 1-10 dari 32 entri</span>

                    <div class="flex items-center gap-2">
                        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Prev</button>
                        <button class="px-3 py-1 bg-yellow-400 text-gray-900 rounded-lg hover:bg-yellow-500">1</button>
                        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">2</button>
                        <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Next</button>
                    </div>
                </div>

            </div>

            <div class="bg-white mt-8 p-6 rounded-xl shadow col-span-1 md:col-span-2">
                            <!-- Grafik Pengeluaran -->
            <div class="bg-white p-6 rounded-xl shadow my-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Grafik Pengeluaran Bulanan</h3>
                <canvas id="chartPengeluaran" height="80"></canvas>
            </div>

            <!-- Grafik Perbandingan -->
            <div class="bg-white p-6 rounded-xl shadow mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Perbandingan Pengeluaran vs Penjualan</h3>
                <canvas id="chartBanding" height="80"></canvas>
            </div>
            </div>


        </main>
    </div>

    <script>
        feather.replace();
        feather.replace();

// STYLE GLOBAL SUPAYA MIRIP HALAMAN PENJUALAN
Chart.defaults.font.family = "Inter";
Chart.defaults.color = "#475569";
Chart.defaults.borderColor = "rgba(0,0,0,0.08)";

// --- GRAFIK PENGELUARAN (LINE CHART) ---
new Chart(document.getElementById('chartPengeluaran'), {
    type: 'line',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
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
            pointHoverRadius: 7
        }]
    },
    options: {
        responsive: true,
        plugins: {
            tooltip: {
                backgroundColor: "#1e293b",
                titleColor: "#fff",
                bodyColor: "#fff",
                padding: 12,
                borderWidth: 0,
                cornerRadius: 8
            },
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                grid: { drawBorder: false },
                ticks: {
                    callback: value => "Rp " + value.toLocaleString()
                }
            },
            x: { grid: { display: false } }
        }
    }
});

// --- GRAFIK PERBANDINGAN (BAR CHART) ---
new Chart(document.getElementById('chartBanding'), {
    type: 'bar',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei"],
        datasets: [
            {
                label: "Pengeluaran",
                data: [1200000, 1400000, 1300000, 1500000, 1600000],
                backgroundColor: "rgba(239,68,68,0.7)",
                borderColor: "#ef4444",
                borderWidth: 1.5,
                borderRadius: 6
            },
            {
                label: "Penjualan",
                data: [2000000, 2200000, 2100000, 2500000, 3000000],
                backgroundColor: "rgba(16,185,129,0.7)",
                borderColor: "#10b981",
                borderWidth: 1.5,
                borderRadius: 6
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            tooltip: {
                backgroundColor: "#1e293b",
                titleColor: "#fff",
                bodyColor: "#fff",
                padding: 12,
                borderWidth: 0,
                cornerRadius: 8
            },
            legend: {
                labels: {
                    padding: 20,
                    boxWidth: 12,
                    boxHeight: 12
                }
            }
        },
        scales: {
            y: {
                grid: { drawBorder: false },
                ticks: {
                    callback: value => "Rp " + value.toLocaleString()
                }
            },
            x: {
                grid: { display: false }
            }
        }
    }
});

    </script>

</body>

</html>
