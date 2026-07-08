<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Edukasi Pajak') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            {{-- Categories Filter --}}
            <div class="flex flex-wrap gap-2 mb-8">
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-primary-600 text-white transition-colors">Semua</button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">PPh 21</button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">PPN</button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">UMKM</button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">Pajak Badan</button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">Pajak Daerah</button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">Tips & Trik</button>
            </div>

            {{-- Article Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <article class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-primary-50 text-primary-700">PPh 21</span>
                            <span class="text-xs text-slate-400">12 Jun 2026</span>
                        </div>
                        <h3 class="font-heading font-semibold text-slate-900 mb-2">Panduan Lengkap PPh 21 Karyawan 2026</h3>
                        <p class="text-sm text-slate-500 mb-4 line-clamp-2">Pelajari cara menghitung PPh 21 karyawan dengan tarif terbaru berdasarkan UU HPP. Termasuk contoh perhitungan untuk berbagai status PTKP.</p>
                        <a href="{{ route('education.show', 1) }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 inline-flex items-center gap-1">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </article>

                <article class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01"/></svg>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-50 text-green-700">PPN</span>
                            <span class="text-xs text-slate-400">10 Jun 2026</span>
                        </div>
                        <h3 class="font-heading font-semibold text-slate-900 mb-2">Memahami PPN 11% dan Cara Menghitungnya</h3>
                        <p class="text-sm text-slate-500 mb-4 line-clamp-2">Penjelasan lengkap tentang PPN 11%, cara menghitung, dan kewajiban pelaporan bagi pengusaha kena pajak.</p>
                        <a href="{{ route('education.show', 2) }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 inline-flex items-center gap-1">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </article>

                <article class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-orange-500 to-orange-700 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-orange-50 text-orange-700">UMKM</span>
                            <span class="text-xs text-slate-400">8 Jun 2026</span>
                        </div>
                        <h3 class="font-heading font-semibold text-slate-900 mb-2">Panduan Pajak UMKM PP 23 Tahun 2018</h3>
                        <p class="text-sm text-slate-500 mb-4 line-clamp-2">Ketentuan terbaru pajak UMKM dengan tarif 0,5% dari omzet. Simak syarat dan ketentuannya agar usaha Anda compliant.</p>
                        <a href="{{ route('education.show', 3) }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 inline-flex items-center gap-1">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </article>

                <article class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-50 text-blue-700">Pajak Badan</span>
                            <span class="text-xs text-slate-400">5 Jun 2026</span>
                        </div>
                        <h3 class="font-heading font-semibold text-slate-900 mb-2">Tarif PPh Badan 2026: Yang Perlu Anda Tahu</h3>
                        <p class="text-sm text-slate-500 mb-4 line-clamp-2">Perubahan tarif PPh Badan berdasarkan UU HPP dan bagaimana menghitung pajak terutang perusahaan Anda.</p>
                        <a href="{{ route('education.show', 4) }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 inline-flex items-center gap-1">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </article>

                <article class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-purple-500 to-purple-700 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-purple-50 text-purple-700">Tips & Trik</span>
                            <span class="text-xs text-slate-400">3 Jun 2026</span>
                        </div>
                        <h3 class="font-heading font-semibold text-slate-900 mb-2">5 Strategi Optimasi Pajak yang Legal</h3>
                        <p class="text-sm text-slate-500 mb-4 line-clamp-2">Tax planning yang efektif dan legal untuk mengurangi beban pajak. Termasuk pemanfaatan insentif dan deductible expenses.</p>
                        <a href="{{ route('education.show', 5) }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 inline-flex items-center gap-1">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </article>

                <article class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-red-50 text-red-700">Pajak Daerah</span>
                            <span class="text-xs text-slate-400">1 Jun 2026</span>
                        </div>
                        <h3 class="font-heading font-semibold text-slate-900 mb-2">Panduan Lengkap Pajak Kendaraan Bermotor</h3>
                        <p class="text-sm text-slate-500 mb-4 line-clamp-2">Cara menghitung PKB, SWDKLLJ, dan denda keterlambatan. Lengkap dengan simulasi untuk berbagai jenis kendaraan.</p>
                        <a href="{{ route('education.show', 6) }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 inline-flex items-center gap-1">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </article>
            </div>

            {{-- Pagination --}}
            <div class="mt-8 flex justify-center">
                <div class="flex gap-2">
                    <button class="px-3 py-1.5 text-sm border border-slate-300 rounded-lg text-slate-500 hover:bg-slate-50 transition-colors" disabled>Sebelumnya</button>
                    <button class="px-3 py-1.5 text-sm bg-primary-600 text-white rounded-lg">1</button>
                    <button class="px-3 py-1.5 text-sm border border-slate-300 rounded-lg text-slate-500 hover:bg-slate-50">2</button>
                    <button class="px-3 py-1.5 text-sm border border-slate-300 rounded-lg text-slate-500 hover:bg-slate-50">3</button>
                    <button class="px-3 py-1.5 text-sm border border-slate-300 rounded-lg text-slate-500 hover:bg-slate-50">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
