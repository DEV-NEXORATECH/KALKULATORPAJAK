<x-guest-layout>
    {{-- Hero Section --}}
    <div class="min-h-screen bg-slate-50">
        <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-primary-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Navbar --}}
                <nav class="flex items-center justify-between h-16 border-b border-white/10">
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-heading font-bold text-white tracking-tight">Pajak<span class="text-primary-400">Ku</span></span>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors">Daftar Gratis</a>
                    </div>
                </nav>

                {{-- Hero Content --}}
                <div class="py-20 md:py-28 text-center">
                    <h1 class="font-heading font-bold text-4xl md:text-5xl lg:text-6xl text-white leading-tight mb-6">
                        Hitung Pajak Jadi<br>
                        <span class="text-primary-400">Lebih Mudah & Cepat</span>
                    </h1>
                    <p class="text-lg md:text-xl text-slate-300 max-w-2xl mx-auto mb-10">
                        Kalkulator pajak all-in-one untuk PPh 21, PPN, Pajak UMKM, dan lainnya. 
                        Lengkap dengan edukasi, pengingat, dan kalender pajak.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl shadow-lg shadow-primary-600/25 transition-all hover:shadow-xl hover:shadow-primary-600/30 text-lg">
                            Mulai Gratis
                        </a>
                        <a href="#calculators" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl border border-white/20 backdrop-blur-sm transition-all text-lg">
                            Coba Kalkulator
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-10">
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-8 grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-slate-200">
                <div class="py-4 md:py-0 text-center">
                    <p class="text-3xl font-heading font-bold text-primary-600">12+</p>
                    <p class="text-sm text-slate-500 mt-1">Jenis Kalkulator</p>
                </div>
                <div class="py-4 md:py-0 text-center">
                    <p class="text-3xl font-heading font-bold text-primary-600">50K+</p>
                    <p class="text-sm text-slate-500 mt-1">Pengguna Aktif</p>
                </div>
                <div class="py-4 md:py-0 text-center">
                    <p class="text-3xl font-heading font-bold text-primary-600">100%</p>
                    <p class="text-sm text-slate-500 mt-1">Gratis</p>
                </div>
            </div>
        </div>

        {{-- Calculator Grid --}}
        <div id="calculators" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center mb-12">
                <h2 class="font-heading font-bold text-3xl text-slate-900 mb-4">Semua Kalkulator Pajak</h2>
                <p class="text-slate-500 max-w-xl mx-auto">Hitung berbagai jenis pajak dengan mudah menggunakan kalkulator interaktif kami.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <a href="{{ route('kalkulator.pph21') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-primary-200 transition-all">
                    <div class="w-12 h-12 rounded-lg bg-primary-50 flex items-center justify-center mb-4 group-hover:bg-primary-100 transition-colors">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-slate-900 mb-2">PPh 21 Karyawan</h3>
                    <p class="text-sm text-slate-500 mb-4">Hitung PPh 21 karyawan dengan tarif progresif terbaru.</p>
                    <span class="text-sm font-medium text-primary-600 group-hover:text-primary-700 inline-flex items-center gap-1">
                        Coba Gratis
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>

                <a href="{{ route('kalkulator.take-home-pay') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-primary-200 transition-all">
                    <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center mb-4 group-hover:bg-green-100 transition-colors">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-slate-900 mb-2">Take Home Pay</h3>
                    <p class="text-sm text-slate-500 mb-4">Hitung gaji bersih setelah potongan pajak dan BPJS.</p>
                    <span class="text-sm font-medium text-primary-600 group-hover:text-primary-700 inline-flex items-center gap-1">
                        Coba Gratis
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>

                <a href="{{ route('kalkulator.gross-up') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-primary-200 transition-all">
                    <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center mb-4 group-hover:bg-blue-100 transition-colors">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-slate-900 mb-2">Gross Up</h3>
                    <p class="text-sm text-slate-500 mb-4">Hitung gaji bruto dari target take home pay.</p>
                    <span class="text-sm font-medium text-primary-600 group-hover:text-primary-700 inline-flex items-center gap-1">
                        Coba Gratis
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>

                <a href="{{ route('kalkulator.thr-bonus') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-primary-200 transition-all">
                    <div class="w-12 h-12 rounded-lg bg-purple-50 flex items-center justify-center mb-4 group-hover:bg-purple-100 transition-colors">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-slate-900 mb-2">THR / Bonus</h3>
                    <p class="text-sm text-slate-500 mb-4">Hitung pajak THR dan bonus tahunan.</p>
                    <span class="text-sm font-medium text-primary-600 group-hover:text-primary-700 inline-flex items-center gap-1">
                        Coba Gratis
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>

                <a href="{{ route('kalkulator.ppn') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-primary-200 transition-all">
                    <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center mb-4 group-hover:bg-green-100 transition-colors">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-slate-900 mb-2">PPN</h3>
                    <p class="text-sm text-slate-500 mb-4">Hitung PPN 11% untuk transaksi jual beli.</p>
                    <span class="text-sm font-medium text-primary-600 group-hover:text-primary-700 inline-flex items-center gap-1">
                        Coba Gratis
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>

                <a href="{{ route('kalkulator.umkm') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-primary-200 transition-all">
                    <div class="w-12 h-12 rounded-lg bg-orange-50 flex items-center justify-center mb-4 group-hover:bg-orange-100 transition-colors">
                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-slate-900 mb-2">PPh Final UMKM</h3>
                    <p class="text-sm text-slate-500 mb-4">Hitung PPh Final 0,5% untuk UMKM PP 23.</p>
                    <span class="text-sm font-medium text-primary-600 group-hover:text-primary-700 inline-flex items-center gap-1">
                        Coba Gratis
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>

                <a href="{{ route('kalkulator.freelancer') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-primary-200 transition-all">
                    <div class="w-12 h-12 rounded-lg bg-cyan-50 flex items-center justify-center mb-4 group-hover:bg-cyan-100 transition-colors">
                        <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-slate-900 mb-2">Freelancer</h3>
                    <p class="text-sm text-slate-500 mb-4">Hitung pajak penghasilan freelancer.</p>
                    <span class="text-sm font-medium text-primary-600 group-hover:text-primary-700 inline-flex items-center gap-1">
                        Coba Gratis
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>

                <a href="{{ route('kalkulator.badan') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-primary-200 transition-all">
                    <div class="w-12 h-12 rounded-lg bg-indigo-50 flex items-center justify-center mb-4 group-hover:bg-indigo-100 transition-colors">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-slate-900 mb-2">Pajak Badan</h3>
                    <p class="text-sm text-slate-500 mb-4">Hitung PPh Badan dengan tarif 22%.</p>
                    <span class="text-sm font-medium text-primary-600 group-hover:text-primary-700 inline-flex items-center gap-1">
                        Coba Gratis
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>

                <a href="{{ route('kalkulator.dividen') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-primary-200 transition-all">
                    <div class="w-12 h-12 rounded-lg bg-pink-50 flex items-center justify-center mb-4 group-hover:bg-pink-100 transition-colors">
                        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-slate-900 mb-2">Pajak Dividen</h3>
                    <p class="text-sm text-slate-500 mb-4">Hitung pajak dividen WP DN & LN.</p>
                    <span class="text-sm font-medium text-primary-600 group-hover:text-primary-700 inline-flex items-center gap-1">
                        Coba Gratis
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>

                <a href="{{ route('kalkulator.kendaraan') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-primary-200 transition-all">
                    <div class="w-12 h-12 rounded-lg bg-yellow-50 flex items-center justify-center mb-4 group-hover:bg-yellow-100 transition-colors">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-slate-900 mb-2">Pajak Kendaraan</h3>
                    <p class="text-sm text-slate-500 mb-4">Hitung PKB, SWDKLLJ, dan denda.</p>
                    <span class="text-sm font-medium text-primary-600 group-hover:text-primary-700 inline-flex items-center gap-1">
                        Coba Gratis
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>

                <a href="{{ route('kalkulator.properti') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-primary-200 transition-all">
                    <div class="w-12 h-12 rounded-lg bg-teal-50 flex items-center justify-center mb-4 group-hover:bg-teal-100 transition-colors">
                        <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-slate-900 mb-2">Pajak Properti</h3>
                    <p class="text-sm text-slate-500 mb-4">Hitung BPHTB, PBB, pajak sewa.</p>
                    <span class="text-sm font-medium text-primary-600 group-hover:text-primary-700 inline-flex items-center gap-1">
                        Coba Gratis
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>

                <a href="{{ route('kalkulator.simulasi') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-primary-200 transition-all">
                    <div class="w-12 h-12 rounded-lg bg-rose-50 flex items-center justify-center mb-4 group-hover:bg-rose-100 transition-colors">
                        <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-slate-900 mb-2">Simulasi Perbandingan</h3>
                    <p class="text-sm text-slate-500 mb-4">Bandingkan skenario pajak berbeda.</p>
                    <span class="text-sm font-medium text-primary-600 group-hover:text-primary-700 inline-flex items-center gap-1">
                        Coba Gratis
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>
            </div>
        </div>

        {{-- Features --}}
        <div class="bg-slate-50 border-t border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <div class="text-center mb-12">
                    <h2 class="font-heading font-bold text-3xl text-slate-900 mb-4">Fitur Lengkap untuk Kebutuhan Pajak Anda</h2>
                    <p class="text-slate-500 max-w-xl mx-auto">Semua yang Anda butuhkan untuk mengelola pajak dalam satu platform.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 rounded-2xl bg-primary-50 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="font-heading font-semibold text-lg text-slate-900 mb-2">12+ Kalkulator</h3>
                        <p class="text-sm text-slate-500">Dari PPh 21 hingga pajak properti, semua tersedia.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 rounded-2xl bg-green-50 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="font-heading font-semibold text-lg text-slate-900 mb-2">Riwayat Lengkap</h3>
                        <p class="text-sm text-slate-500">Semua hasil perhitungan tersimpan otomatis.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 rounded-2xl bg-orange-50 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <h3 class="font-heading font-semibold text-lg text-slate-900 mb-2">Pengingat Cerdas</h3>
                        <p class="text-sm text-slate-500">Tidak pernah telat bayar pajak lagi.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="bg-gradient-to-br from-primary-600 to-primary-700">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
                <h2 class="font-heading font-bold text-3xl text-white mb-4">Siap Menghitung Pajak?</h2>
                <p class="text-primary-100 text-lg mb-8">Daftar gratis sekarang dan mulai hitung pajak dengan mudah.</p>
                <a href="{{ route('register') }}" class="inline-flex px-8 py-4 bg-white text-primary-700 font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all text-lg">
                    Daftar Gratis Sekarang
                </a>
            </div>
        </div>

        {{-- Footer --}}
        <footer class="bg-slate-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <span class="text-xl font-heading font-bold text-white tracking-tight">Pajak<span class="text-primary-400">Ku</span></span>
                    <p class="text-sm text-slate-400">&copy; {{ date('Y') }} PajakKu. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</x-guest-layout>
