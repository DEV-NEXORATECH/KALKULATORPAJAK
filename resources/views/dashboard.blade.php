<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-heading font-semibold text-xl text-slate-900 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <span class="text-sm text-slate-500">{{ date('d F Y') }}</span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 lg:px-6">
            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Total Pajak Tahun Ini</p>
                            <p class="text-2xl font-heading font-bold text-slate-900 mt-1">Rp 12.500.000</p>
                            <p class="text-xs text-green-500 mt-1 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                +12% dari tahun lalu
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-primary-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Total Perhitungan</p>
                            <p class="text-2xl font-heading font-bold text-slate-900 mt-1">24</p>
                            <p class="text-xs text-slate-400 mt-1">Bulan ini</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Kalkulator Favorit</p>
                            <p class="text-2xl font-heading font-bold text-slate-900 mt-1">PPh 21</p>
                            <p class="text-xs text-slate-400 mt-1">10x digunakan</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-orange-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Recent Calculations --}}
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200">
                    <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                        <h3 class="font-heading font-semibold text-slate-900">Perhitungan Terbaru</h3>
                        <a href="{{ route('history.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
                    </div>
                    <div class="divide-y divide-slate-100">
                        <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                            <div>
                                <p class="text-sm font-medium text-slate-900">PPh 21 Karyawan</p>
                                <p class="text-xs text-slate-500">12 Jun 2026</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-slate-900">Rp 2.450.000</p>
                                <p class="text-xs text-slate-400">/tahun</p>
                            </div>
                        </div>
                        <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                            <div>
                                <p class="text-sm font-medium text-slate-900">PPN Pembelian</p>
                                <p class="text-xs text-slate-500">10 Jun 2026</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-slate-900">Rp 1.100.000</p>
                                <p class="text-xs text-slate-400">PPN</p>
                            </div>
                        </div>
                        <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                            <div>
                                <p class="text-sm font-medium text-slate-900">Take Home Pay</p>
                                <p class="text-xs text-slate-500">8 Jun 2026</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-slate-900">Rp 7.850.000</p>
                                <p class="text-xs text-slate-400">/bulan</p>
                            </div>
                        </div>
                        <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                            <div>
                                <p class="text-sm font-medium text-slate-900">Pajak Kendaraan</p>
                                <p class="text-xs text-slate-500">5 Jun 2026</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-slate-900">Rp 1.450.000</p>
                                <p class="text-xs text-slate-400">/tahun</p>
                            </div>
                        </div>
                        <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                            <div>
                                <p class="text-sm font-medium text-slate-900">PPh Final UMKM</p>
                                <p class="text-xs text-slate-500">3 Jun 2026</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-slate-900">Rp 500.000</p>
                                <p class="text-xs text-slate-400">/tahun</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Access & Calendar --}}
                <div class="space-y-6">
                    {{-- Quick Access --}}
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h3 class="font-heading font-semibold text-slate-900 mb-4">Akses Cepat</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('kalkulator.pph21') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg bg-primary-50 hover:bg-primary-100 transition-colors group">
                                <svg class="w-6 h-6 text-primary-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                <span class="text-xs font-medium text-primary-700">PPh 21</span>
                            </a>
                            <a href="{{ route('kalkulator.ppn') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg bg-green-50 hover:bg-green-100 transition-colors group">
                                <svg class="w-6 h-6 text-green-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01"/></svg>
                                <span class="text-xs font-medium text-green-600">PPN</span>
                            </a>
                            <a href="{{ route('kalkulator.umkm') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg bg-orange-50 hover:bg-orange-100 transition-colors group">
                                <svg class="w-6 h-6 text-orange-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span class="text-xs font-medium text-orange-600">UMKM</span>
                            </a>
                            <a href="{{ route('kalkulator.kendaraan') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors group">
                                <svg class="w-6 h-6 text-blue-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                <span class="text-xs font-medium text-blue-600">Kendaraan</span>
                            </a>
                        </div>
                    </div>

                    {{-- Calendar Widget --}}
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-heading font-semibold text-slate-900">Jadwal Pajak</h3>
                            <a href="{{ route('reminder.kalender') }}" class="text-xs text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-lg bg-primary-50 flex flex-col items-center justify-center text-center shrink-0">
                                    <span class="text-xs font-bold text-primary-600 leading-none">15</span>
                                    <span class="text-[10px] text-primary-500 leading-none">Jul</span>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900">Batas Lapor PPh 21</p>
                                    <p class="text-xs text-slate-400">Masa Juni 2026</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-lg bg-red-50 flex flex-col items-center justify-center text-center shrink-0">
                                    <span class="text-xs font-bold text-red-600 leading-none">20</span>
                                    <span class="text-[10px] text-red-500 leading-none">Jul</span>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900">Batas Bayar PPN</p>
                                    <p class="text-xs text-slate-400">Masa Juni 2026</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-lg bg-green-50 flex flex-col items-center justify-center text-center shrink-0">
                                    <span class="text-xs font-bold text-green-600 leading-none">31</span>
                                    <span class="text-[10px] text-green-500 leading-none">Jul</span>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900">Batas Lapor PPN</p>
                                    <p class="text-xs text-slate-400">Masa Juni 2026</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
