@extends('layouts.auth')
@section('bodyClass', 'flex items-center justify-center min-h-screen p-4')
@section('content')
    <div class="w-full max-w-md bg-white/70 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/40 p-8">

        {{-- Logo --}}
        <div class="text-center mb-8">

            <div
                class="inline-flex items-center justify-center h-28 w-28 rounded-full bg-white shadow-xl border border-gray-100">

                {{-- SVG TELUR MATA SAPI (Sunny Side Up) --}}
                <svg width="90" height="90" viewBox="0 0 120 120">
                    <!-- Putih Telur (asymmetric organic shape) -->
                    <path d="
                                M60 20
                                C90 18, 110 40, 105 65
                                C100 90, 70 105, 45 100
                                C20 95, 10 70, 22 50
                                C35 28, 45 22, 60 20Z" fill="#FFFAF0" stroke="#F3EAD8" stroke-width="3"
                        class="drop-shadow-md" />

                    <!-- Kuning Telur -->
                    <circle cx="65" cy="63" r="22" fill="#FBBF24" />

                    <!-- Inner Shadow -->
                    <circle cx="68" cy="66" r="16" fill="#F59E0B" opacity="0.7" />

                    <!-- Highlight -->
                    <ellipse cx="58" cy="55" rx="10" ry="6" fill="white" opacity="0.45" />
                </svg>

            </div>

            <h1 class="mt-6 text-3xl font-extrabold text-[var(--dark-green-text)] tracking-tight">
                Selamat Datang
            </h1>
            <p class="text-gray-700 mt-1">
                Masuk untuk mengelola peternakan Anda secara digital
            </p>
        </div>

        {{-- Form --}}
        <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-6">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda"
                        class="w-full mt-1 rounded-lg bg-gray-100 border-gray-300 py-3 px-4 shadow-sm
                               focus:border-[var(--primary-accent)] focus:ring-[var(--primary-accent)]
                               transition-all @error('email') border-red-500 @enderror"
                        required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div x-data="{ show: false }">
                    <label class="text-sm font-medium text-gray-700">Kata Sandi</label>

                    <div class="relative">

                        <input :type="show ? 'text' : 'password'" name="password" placeholder="Masukkan kata sandi Anda"
                            class="w-full mt-1 rounded-lg bg-gray-100 border-gray-300 py-3 px-4 pr-12 shadow-sm
                                   focus:border-[var(--primary-accent)] focus:ring-[var(--primary-accent)]
                                   transition-all @error('password') border-red-500 @enderror"
                            required>

                        {{-- Toggle Eye --}}
                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-600 hover:text-gray-900">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.543-7a9.97 9.97 0 012.186-3.46M6.228 6.228A9.969 9.969 0 0112 5c4.477 0 8.268 2.943
                                            9.543 7a9.97 9.97 0 01-3.168 4.568M9.88 9.88a3 3 0 104.243 4.243" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                            </svg>
                        </button>

                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('password.request') }}"
                        class="text-sm font-medium text-[var(--dark-green-text)] hover:underline">
                        Lupa Kata Sandi?
                    </a>
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-lg bg-[var(--primary-accent)] text-gray-900 font-semibold
                           shadow-md hover:bg-[var(--primary-accent-hover)]
                           transition focus:ring-2 focus:ring-[var(--primary-accent-hover)] focus:ring-offset-2">
                    Masuk
                </button>

            </form>
        </div>

        {{-- Register --}}
        <p class="mt-6 text-center text-sm text-[var(--gray-text)]">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-[var(--dark-green-text)] hover:underline">
                Daftar akun
            </a>
        </p>
    </div>
@endsection
