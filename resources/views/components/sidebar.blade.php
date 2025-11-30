@extends('layouts.app')

@section('content')

    <div class="min-h-screen flex relative">
        <!-- SIDEBAR -->
        <aside
            class="bg-white shadow-xl border-r border-gray-200 w-72 transform transition-transform duration-300 ease-in-out z-50
                   fixed inset-y-0 left-0 h-screen"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">

            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center shadow-lg">
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

                <a href="/dashboard"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl group
   {{ request()->is('dashboard') ? 'bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 shadow-md' : 'hover:bg-gray-50 text-gray-600 hover:text-gray-900' }}">
                    <i data-feather="layout" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Dashboard</span>
                </a>

                <a href="/kandang"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl group
   {{ request()->is('kandang') ? 'bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 shadow-md' : 'hover:bg-gray-50 text-gray-600 hover:text-gray-900' }}">
                    <i data-feather="home" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Manajemen Kandang</span>
                </a>

                <a href="/telur"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl group
   {{ request()->is('telur') ? 'bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 shadow-md' : 'hover:bg-gray-50 text-gray-600 hover:text-gray-900' }}">
                    <i data-feather="package" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Manajemen Telur</span>
                </a>

                <a href="/managemenpenjualan"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl group
   {{ request()->is('managemenpenjualan') ? 'bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 shadow-md' : 'hover:bg-gray-50 text-gray-600 hover:text-gray-900' }}">
                    <i data-feather="shopping-bag" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Manajemen Penjualan</span>
                </a>

                <a href="/managemenpengeluaran"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl group
   {{ request()->is('managemenpengeluaran') ? 'bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 shadow-md' : 'hover:bg-gray-50 text-gray-600 hover:text-gray-900' }}">
                    <i data-feather="shopping-cart" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Manajemen Pengeluaran</span>
                </a>

                <a href="/pembukuan"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl group
   {{ request()->is('pembukuan') ? 'bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 shadow-md' : 'hover:bg-gray-50 text-gray-600 hover:text-gray-900' }}">
                    <i data-feather="file-text" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Pembukuan</span>
                </a>



            </nav>
        </aside>
    </div>
