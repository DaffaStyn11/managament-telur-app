<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kandang</title>

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

    <!-- Layout -->
    <div class="min-h-screen flex">

        <!-- SIDEBAR -->
        <aside
            class="bg-white shadow-md border-r w-64 transform transition-all duration-300 ease-in-out z-50
                   fixed md:static inset-y-0 left-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'">

            <div class="p-6 border-b flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-700">🐔 Manajemen Telur</h1>

                <!-- Close button (Mobile Only) -->
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

                <!-- ACTIVE MENU -->
                <a href="/managemenkandang"
                    class="flex items-center gap-3 px-2 py-2 rounded-lg bg-yellow-400 font-semibold text-gray-900">
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
        <main class="flex-1 p-6 transition-all duration-300 ">

            <!-- HEADER -->
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

                        <form>
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-2 px-4 py-3 text-left hover:bg-red-50 text-red-600 text-sm">
                                <i data-feather="log-out"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="layout-content-container flex flex-col w-full">

                {{-- TITLE + ADD BUTTON --}}
                <div class="flex flex-col gap-1 mb-6">
                    <p class="text-2xl font-bold text-gray-800">Manajemen Kandang</p>
                    <p class="text-gray-600 text-sm">Kelola kandang ayam Anda secara efisien.</p>
                </div>

                {{-- <button
                            class="flex items-center gap-2 h-10 px-4 text-sm font-bold text-white bg-[#2a662a] rounded-lg">
                            <svg fill="currentColor" height="20" width="20" viewBox="0 0 256 256">
                                <path
                                    d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z" />
                            </svg>
                            <span>Tambah Kandang</span>
                        </button> --}}
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


            <!-- CARD DATA -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                <div class="bg-white p-6 rounded-xl shadow flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Total Kandang</h3>
                        <i data-feather="home"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">4</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Total Ayam</h3>
                        <i data-feather="layers"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">450</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Produksi per Hari</h3>
                        <i data-feather="egg"></i>
                    </div>
                    <p class="text-3xl font-bold mt-2">380</p>
                </div>

            </div>

            <!-- TABLE DATA KANDANG -->
            <div class="bg-white p-6 rounded-xl shadow">

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Daftar Kandang</h3>

                    <a href="#"
                        class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg shadow hover:bg-yellow-500 font-semibold flex items-center gap-2">
                        <i data-feather="plus"></i>
                        Tambah Kandang
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="p-3 text-left">Nama Kandang</th>
                                <th class="p-3 text-left">Jumlah Ayam</th>
                                <th class="p-3 text-left">Jenis Ayam</th>
                                <th class="p-3 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">Kandang 1</td>
                                <td class="p-3">120</td>
                                <td class="p-3">Golden Red</td>
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
                                <td class="p-3">Kandang 2</td>
                                <td class="p-3">90</td>
                                <td class="p-3">Arab Putih</td>
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
                                <td class="p-3">Kandang 3</td>
                                <td class="p-3">110</td>
                                <td class="p-3">Golden Red</td>
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
                                <td class="p-3">Kandang 4</td>
                                <td class="p-3">130</td>
                                <td class="p-3">Arab Putih</td>
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
