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
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Profil Saya</h2>
                    <p class="text-gray-600">Kelola informasi profil dan keamanan akun Anda.</p>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div
                        class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl flex items-center gap-3">
                        <span class="material-symbols-outlined">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- LEFT COLUMN - Profile Card -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                            <div class="flex flex-col items-center text-center">
                                <!-- Avatar -->
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mb-4">
                                    <span class="material-symbols-outlined text-5xl text-white">person</span>
                                </div>

                                <!-- User Info -->
                                <h3 class="text-xl font-bold text-gray-900 mb-1">{{ Auth::user()->name }}</h3>
                                <p class="text-sm text-gray-600 mb-4">{{ Auth::user()->email }}</p>


                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN - Forms -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- Update Profile Form -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-blue-100 rounded-lg">
                                        <span class="material-symbols-outlined text-blue-600">person</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">Informasi Profil</h3>
                                        <p class="text-sm text-gray-600">Perbarui nama dan email Anda</p>
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('profile.update') }}" class="p-6 space-y-5">
                                @csrf
                                @method('PUT')

                                <!-- Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                        class="w-full rounded-lg bg-gray-50 border-gray-300 py-3 px-4 shadow-sm
                                               focus:border-yellow-500 focus:ring-yellow-500 transition-all
                                               @error('name') border-red-500 @enderror"
                                        required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                        class="w-full rounded-lg bg-gray-50 border-gray-300 py-3 px-4 shadow-sm
                                               focus:border-yellow-500 focus:ring-yellow-500 transition-all
                                               @error('email') border-red-500 @enderror"
                                        required>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-end pt-4">
                                    <button type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 rounded-xl font-semibold hover:shadow-md transition flex items-center gap-2">
                                        <span class="material-symbols-outlined text-xl">save</span>
                                        <span>Simpan Perubahan</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Update Password Form -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-red-100 rounded-lg">
                                        <span class="material-symbols-outlined text-red-600">lock</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">Keamanan Password</h3>
                                        <p class="text-sm text-gray-600">Ubah password untuk keamanan akun Anda</p>
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('profile.password') }}" class="p-6 space-y-5">
                                @csrf
                                @method('PUT')

                                <!-- Current Password -->
                                <div x-data="{ show: false }">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                                    <div class="relative">
                                        <input :type="show ? 'text' : 'password'" name="current_password"
                                            placeholder="Masukkan password saat ini"
                                            class="w-full rounded-lg bg-gray-50 border-gray-300 py-3 px-4 pr-12 shadow-sm
                                                   focus:border-yellow-500 focus:ring-yellow-500 transition-all
                                                   @error('current_password') border-red-500 @enderror"
                                            required>
                                        <button type="button" @click="show = !show"
                                            class="absolute inset-y-0 right-4 flex items-center text-gray-500 hover:text-gray-700">
                                            <span class="material-symbols-outlined text-xl" x-show="!show">visibility</span>
                                            <span class="material-symbols-outlined text-xl" x-show="show"
                                                x-cloak>visibility_off</span>
                                        </button>
                                    </div>
                                    @error('current_password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div x-data="{ show: false }">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                    <div class="relative">
                                        <input :type="show ? 'text' : 'password'" name="password"
                                            placeholder="Masukkan password baru (min. 8 karakter)"
                                            class="w-full rounded-lg bg-gray-50 border-gray-300 py-3 px-4 pr-12 shadow-sm
                                                   focus:border-yellow-500 focus:ring-yellow-500 transition-all
                                                   @error('password') border-red-500 @enderror"
                                            required>
                                        <button type="button" @click="show = !show"
                                            class="absolute inset-y-0 right-4 flex items-center text-gray-500 hover:text-gray-700">
                                            <span class="material-symbols-outlined text-xl" x-show="!show">visibility</span>
                                            <span class="material-symbols-outlined text-xl" x-show="show"
                                                x-cloak>visibility_off</span>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div x-data="{ show: false }">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password
                                        Baru</label>
                                    <div class="relative">
                                        <input :type="show ? 'text' : 'password'" name="password_confirmation"
                                            placeholder="Masukkan ulang password baru"
                                            class="w-full rounded-lg bg-gray-50 border-gray-300 py-3 px-4 pr-12 shadow-sm
                                                   focus:border-yellow-500 focus:ring-yellow-500 transition-all"
                                            required>
                                        <button type="button" @click="show = !show"
                                            class="absolute inset-y-0 right-4 flex items-center text-gray-500 hover:text-gray-700">
                                            <span class="material-symbols-outlined text-xl"
                                                x-show="!show">visibility</span>
                                            <span class="material-symbols-outlined text-xl" x-show="show"
                                                x-cloak>visibility_off</span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-end pt-4">
                                    <button type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-semibold hover:shadow-md transition flex items-center gap-2">
                                        <span class="material-symbols-outlined text-xl">lock_reset</span>
                                        <span>Ubah Password</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </main>

            @include('components.footer')

        </div>

    </div>

    <script>
        // Initialize Material Symbols if needed
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
@endsection
