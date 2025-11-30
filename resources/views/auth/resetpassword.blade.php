@extends('layouts.auth')

@section('content')
    <div class="grid min-h-screen grid-cols-1 lg:grid-cols-2">

        {{-- LEFT SIDE --}}
        <div class="flex items-center justify-center p-10">
            <div class="w-full max-w-sm">
                <img src="{{ asset('/assets/images/register.png') }}" alt="Reset Password Illustration"
                    class="w-full rounded-2xl shadow-xl object-cover">
                <p class="mt-5 text-center text-lg font-semibold text-[var(--dark-green-text)]">
                    Sistem Manajemen Telur Digital
                </p>
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="flex items-center justify-center p-6 sm:p-10">

            <div class="w-full max-w-md">

                {{-- Logo + Title --}}
                <div class="mb-8 text-center text-[var(--dark-green-text)]">
                    <div
                        class="inline-flex h-24 w-24 items-center justify-center rounded-full bg-white shadow-xl border border-gray-100">
                        <svg width="90" height="90" viewBox="0 0 120 120">
                            <!-- Putih Telur -->
                            <path d="
                                M60 20
                                C90 18, 110 40, 105 65
                                C100 90, 70 105, 45 100
                                C20 95, 10 70, 22 50
                                C35 28, 45 22, 60 20Z"
                                fill="#FFFAF0"
                                stroke="#F3EAD8"
                                stroke-width="3"
                                class="drop-shadow-md"
                            />

                            <!-- Kuning Telur -->
                            <circle cx="65" cy="63" r="22" fill="#FBBF24"/>

                            <!-- Inner Shadow -->
                            <circle cx="68" cy="66" r="16" fill="#F59E0B" opacity="0.7"/>

                            <!-- Highlight -->
                            <ellipse cx="58" cy="55" rx="10" ry="6" fill="white" opacity="0.45"/>
                        </svg>
                    </div>

                    <h1 class="mt-6 text-3xl font-extrabold tracking-tight">
                        Atur Ulang Kata Sandi
                    </h1>
                    <p class="mt-1 text-base text-gray-700">
                        Masukkan email dan kata sandi baru Anda
                    </p>
                </div>

                {{-- FORM --}}
                <div class="rounded-xl bg-white p-6 shadow-xl sm:p-8">

                    <form method="POST" class="space-y-5">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email" name="email" type="email" placeholder="Masukkan email Anda"
                                class="block w-full rounded-lg border-gray-300 bg-[var(--light-gray)] py-3 px-4 shadow-sm
                                       focus:border-[var(--primary-accent)] focus:ring-[var(--primary-accent)]">
                        </div>

                        {{-- Password Baru --}}
                        <div x-data="{ show: false }">
                            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi Baru</label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" id="password" name="password"
                                    placeholder="Masukkan kata sandi baru"
                                    class="block w-full rounded-lg border-gray-300 bg-[var(--light-gray)] py-3 px-4 pr-14 shadow-sm
                                           focus:border-[var(--primary-accent)] focus:ring-[var(--primary-accent)]">
                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-3 flex items-center justify-center w-10 text-gray-500 hover:text-gray-700">
                                     <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.34-4.362M6.223 6.223A9.96 9.96 0 0112 5c4.477 0 8.268 2.943 9.542 7a10.056 10.056 0 01-4.132 5.225M15 12a3 3 0 00-3-3M3 3l18 18"/>
                                </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div x-data="{ show: false }">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                Konfirmasi Kata Sandi
                            </label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" id="password_confirmation"
                                    name="password_confirmation" placeholder="Ulangi kata sandi baru"
                                    class="block w-full rounded-lg border-gray-300 bg-[var(--light-gray)] py-3 px-4 pr-14 shadow-sm
                                           focus:border-[var(--primary-accent)] focus:ring-[var(--primary-accent)]">
                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-3 flex items-center justify-center w-10 text-gray-500 hover:text-gray-700">
                                     <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.34-4.362M6.223 6.223A9.96 9.96 0 0112 5c4.477 0 8.268 2.943 9.542 7a10.056 10.056 0 01-4.132 5.225M15 12a3 3 0 00-3-3M3 3l18 18"/>
                                </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                            class="w-full rounded-lg bg-[var(--primary-accent)] py-3 px-4 text-sm font-semibold text-gray-900 shadow-sm
                                   hover:bg-[var(--primary-accent-hover)]
                                   focus:ring-2 focus:ring-[var(--primary-accent-hover)] focus:ring-offset-2">
                            Kirim Tautan Reset
                        </button>

                    </form>
                </div>

                {{-- Back to Login --}}
                <p class="mt-8 text-center text-sm text-[var(--gray-text)]">
                    Kembali ke
                    <a href="/" class="font-semibold text-[var(--dark-green-text)] hover:text-green-800">
                        Halaman Masuk
                    </a>
                </p>

            </div>

        </div>
    </div>
@endsection
