<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false, kalkulatorDropdown: false }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PajakKu') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|poppins:500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-800">
    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar Overlay --}}
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/50 z-40 lg:hidden" @click="sidebarOpen = false" style="display: none;"></div>

        {{-- Sidebar --}}
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto lg:z-auto" :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            <div class="flex items-center justify-between h-16 px-6 border-b border-slate-700">
                <span class="text-xl font-heading font-bold text-white tracking-tight">Pajak<span class="text-primary-500">Ku</span></span>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
                {{-- Dashboard --}}
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors" sidebar>
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    {{ __('Dashboard') }}
                </x-nav-link>

                {{-- Kalkulator Pajak Dropdown --}}
                <div x-data="{ open: request()->routeIs('kalkulator.*') }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-800 transition-colors">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            {{ __('Kalkulator Pajak') }}
                        </span>
                        <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="mt-1 ml-8 space-y-1" style="display: none;">
                        <a href="{{ route('kalkulator.pph21') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white hover:bg-slate-800 transition-colors {{ request()->routeIs('kalkulator.pph21') ? 'text-white bg-slate-800' : '' }}">PPh 21 Karyawan</a>
                        <a href="{{ route('kalkulator.take-home-pay') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white hover:bg-slate-800 transition-colors {{ request()->routeIs('kalkulator.take-home-pay') ? 'text-white bg-slate-800' : '' }}">Take Home Pay</a>
                        <a href="{{ route('kalkulator.gross-up') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white hover:bg-slate-800 transition-colors {{ request()->routeIs('kalkulator.gross-up') ? 'text-white bg-slate-800' : '' }}">Gross Up</a>
                        <a href="{{ route('kalkulator.thr-bonus') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white hover:bg-slate-800 transition-colors {{ request()->routeIs('kalkulator.thr-bonus') ? 'text-white bg-slate-800' : '' }}">THR / Bonus</a>
                        <a href="{{ route('kalkulator.ppn') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white hover:bg-slate-800 transition-colors {{ request()->routeIs('kalkulator.ppn') ? 'text-white bg-slate-800' : '' }}">PPN</a>
                        <a href="{{ route('kalkulator.umkm') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white hover:bg-slate-800 transition-colors {{ request()->routeIs('kalkulator.umkm') ? 'text-white bg-slate-800' : '' }}">PPh Final UMKM</a>
                        <a href="{{ route('kalkulator.freelancer') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white hover:bg-slate-800 transition-colors {{ request()->routeIs('kalkulator.freelancer') ? 'text-white bg-slate-800' : '' }}">Freelancer</a>
                        <a href="{{ route('kalkulator.badan') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white hover:bg-slate-800 transition-colors {{ request()->routeIs('kalkulator.badan') ? 'text-white bg-slate-800' : '' }}">Pajak Badan</a>
                        <a href="{{ route('kalkulator.dividen') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white hover:bg-slate-800 transition-colors {{ request()->routeIs('kalkulator.dividen') ? 'text-white bg-slate-800' : '' }}">Pajak Dividen</a>
                        <a href="{{ route('kalkulator.kendaraan') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white hover:bg-slate-800 transition-colors {{ request()->routeIs('kalkulator.kendaraan') ? 'text-white bg-slate-800' : '' }}">Pajak Kendaraan</a>
                        <a href="{{ route('kalkulator.properti') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white hover:bg-slate-800 transition-colors {{ request()->routeIs('kalkulator.properti') ? 'text-white bg-slate-800' : '' }}">Pajak Properti</a>
                        <a href="{{ route('kalkulator.simulasi') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white hover:bg-slate-800 transition-colors {{ request()->routeIs('kalkulator.simulasi') ? 'text-white bg-slate-800' : '' }}">Simulasi Perbandingan</a>
                    </div>
                </div>

                {{-- Riwayat Perhitungan --}}
                <x-nav-link :href="route('history.index')" :active="request()->routeIs('history.*')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors" sidebar>
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ __('Riwayat Perhitungan') }}
                </x-nav-link>

                {{-- Edukasi Pajak --}}
                <x-nav-link :href="route('education.index')" :active="request()->routeIs('education.*')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors" sidebar>
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    {{ __('Edukasi Pajak') }}
                </x-nav-link>

                {{-- FAQ --}}
                <x-nav-link :href="route('faq.index')" :active="request()->routeIs('faq.*')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors" sidebar>
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ __('FAQ') }}
                </x-nav-link>

                {{-- Pengingat Pajak --}}
                <x-nav-link :href="route('reminder.index')" :active="request()->routeIs('reminder.*')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors" sidebar>
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    {{ __('Pengingat Pajak') }}
                </x-nav-link>

                {{-- Kalender Pajak --}}
                <x-nav-link :href="route('reminder.kalender')" :active="request()->routeIs('reminder.kalender')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors" sidebar>
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ __('Kalender Pajak') }}
                </x-nav-link>
            </nav>

            <div class="p-4 border-t border-slate-700">
                <div class="flex items-center gap-3 px-3 py-2 text-xs text-slate-500">
                    <span>&copy; {{ date('Y') }} PajakKu</span>
                    <span class="ml-auto">v1.0</span>
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-w-0">
            {{-- Top Navbar --}}
            <header class="bg-white border-b border-slate-200 shadow-sm">
                <div class="flex items-center justify-between h-16 px-4 lg:px-6">
                    <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-700 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>

                    <div class="flex-1"></div>

                    <div class="flex items-center gap-4">
                        {{-- Notification Bell --}}
                        <button class="relative text-slate-500 hover:text-slate-700 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-green-500 rounded-full"></span>
                        </button>

                        {{-- User Dropdown --}}
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-2 text-sm font-medium text-slate-700 hover:text-slate-900 transition-colors">
                                    <div class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center text-white text-sm font-semibold">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </header>

            {{-- Page Header --}}
            @isset($header)
                <div class="bg-white border-b border-slate-200">
                    <div class="max-w-7xl mx-auto px-4 lg:px-6 py-4">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
