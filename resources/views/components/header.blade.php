

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
