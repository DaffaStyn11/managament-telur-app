<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Telur</title>

    @vite('resources/css/app.css')

    <!-- Icons & Libraries -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">


    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: true }">

    <!-- MAIN LAYOUT -->
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

                <!-- ACTIVE PAGE -->
                <a href="/managementelur"
                    class="flex items-center gap-3 px-2 py-2 rounded-lg bg-yellow-400 font-semibold text-gray-900">
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

            <!-- TOPBAR -->
            <div class="flex items-center justify-between mb-6" x-data="{ open: false }">

                <!-- Toggle Sidebar -->
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

            {{-- TITLE --}}
            <div class="flex flex-col gap-1 mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Manajemen Telur</h2>
                <p class="text-gray-600 text-sm">Kelola data produksi telur dari setiap kandang.</p>
            </div>


            <!-- Toolbar -->
            <div class="mb-4 flex flex-col md:flex-row justify-between items-center gap-4">

                <!-- Search -->
                <div class="relative flex-1 md:max-w-xs">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">
                        search
                    </span>
                    <input type="text"
                        class="w-full h-10 pl-11 pr-4 rounded-lg border border-gray-300 bg-white
                   focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition"
                        placeholder="Cari berdasarkan catatan...">
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center gap-2 flex-wrap">

                    <button
                        class="flex h-10 items-center gap-2 rounded-lg border border-gray-300 px-4 text-sm font-semibold
                   bg-white hover:bg-gray-100 transition shadow-sm">
                        <span class="material-symbols-outlined text-lg text-gray-600">calendar_month</span>
                        Filter Tanggal
                    </button>

                    <button
                        class="flex h-10 items-center gap-2 rounded-lg border border-gray-300 px-4 text-sm font-semibold
                   bg-white hover:bg-gray-100 transition shadow-sm">
                        <span class="material-symbols-outlined text-lg text-green-500">grid_on</span>
                        Cetak Excel
                    </button>

                    <button
                        class="flex h-10 items-center gap-2 rounded-lg border border-gray-300 px-4 text-sm font-semibold
                   bg-white hover:bg-gray-100 transition shadow-sm">
                        <span class="material-symbols-outlined text-lg text-red-500">picture_as_pdf</span>
                        Cetak PDF
                    </button>

                </div>
            </div>


            {{-- CARD SUMMARY --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

                <div class="bg-white p-6 rounded-xl shadow flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Total Telur Hari Ini</h3>
                        <i data-feather="egg"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">380</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Rata-rata Mingguan</h3>
                        <i data-feather="bar-chart-2"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">2.450</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Total Bulanan</h3>
                        <i data-feather="calendar"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">10.800</p>
                </div>

                <!-- ⭐ NEW: Rata-rata Tahunan -->
                <div class="bg-white p-6 rounded-xl shadow flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Rata-rata Tahunan</h3>
                        <i data-feather="pie-chart"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">128.400</p>
                </div>

            </div>

            {{-- TABLE TELUR --}}
            <div class="bg-white p-6 rounded-xl shadow">

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Daftar Produksi Telur</h3>

                    <a href="#"
                        class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg shadow hover:bg-yellow-500 font-semibold flex items-center gap-2">
                        <i data-feather="plus"></i>
                        Tambah Produksi
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">No</th>
                                <th class="p-3 text-left">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Kuantitas</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Jenis Pengemasan (isi)</th>
                                <th class="p-3 text-left">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">1</td>
                                <td class="p-3">27 Nov 2025</td>
                                <td class="p-3">1000</td>
                                <td class="p-3">10</td>
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
                                <td class="p-3">5000</td>
                                <td class="p-3">10</td>
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
                                <td class="p-3">1000</td>
                                <td class="p-3">6</td>
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
                    <div
                        class="flex items-center justify-between border-t border-border-light dark:border-border-dark px-6 py-3">
                        <span class="text-sm text-gray-600">Menampilkan 1-10 dari 50 entri</span>
                        <div class="flex items-center gap-2">
                            <button
                                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Sebelumnya</button>
                            <button
                                class="px-3 py-1 bg-yellow-400 text-gray-900 rounded-lg hover:bg-yellow-500 transition">1</button>
                            <button
                                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">2</button>
                            <button
                                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">3</button>
                            <button
                                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Selanjutnya</button>
                        </div>


                    </div>
                </div>

            </div>

        </main>

    </div>

    <script>
        feather.replace();
    </script>

</body>

</html>
