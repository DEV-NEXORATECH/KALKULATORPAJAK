<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('reminder.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/></svg>
                </a>
                <h2 class="font-heading font-semibold text-xl text-slate-900 leading-tight">
                    {{ __('Kalender Pajak') }}
                </h2>
            </div>
            <div class="flex gap-2">
                <button class="px-3 py-1.5 text-sm border border-slate-300 rounded-lg text-slate-600 hover:bg-slate-50 transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Bulan Sebelumnya
                </button>
                <button class="px-3 py-1.5 text-sm border border-slate-300 rounded-lg text-slate-600 hover:bg-slate-50 transition-colors flex items-center gap-1">
                    Bulan Berikutnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4">
            {{-- Month Header --}}
            <div class="text-center mb-8">
                <h3 class="font-heading font-bold text-2xl text-slate-900">Juli 2026</h3>
            </div>

            {{-- Calendar Grid --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                {{-- Day Names --}}
                <div class="grid grid-cols-7 bg-slate-50 border-b border-slate-200">
                    <div class="py-3 text-center text-sm font-semibold text-slate-500">Min</div>
                    <div class="py-3 text-center text-sm font-semibold text-slate-500">Sen</div>
                    <div class="py-3 text-center text-sm font-semibold text-slate-500">Sel</div>
                    <div class="py-3 text-center text-sm font-semibold text-slate-500">Rab</div>
                    <div class="py-3 text-center text-sm font-semibold text-slate-500">Kam</div>
                    <div class="py-3 text-center text-sm font-semibold text-slate-500">Jum</div>
                    <div class="py-3 text-center text-sm font-semibold text-slate-500">Sab</div>
                </div>

                {{-- Calendar Days --}}
                <div class="grid grid-cols-7 divide-x divide-y divide-slate-100">
                    <template x-for="i in 35" :key="i">
                        <div class="min-h-[100px] p-2 relative" :class="{'bg-slate-50': i <= 4 || i >= 32}">
                            <span class="text-sm font-medium" :class="{
                                'text-slate-400': i <= 4 || i >= 32,
                                'text-slate-900': i > 4 && i < 32,
                                'bg-primary-600 text-white w-7 h-7 flex items-center justify-center rounded-full': i === 10
                            }" x-text="i - 4"></span>

                            {{-- Event on 15th --}}
                            <div x-show="i === 19" class="mt-1">
                                <div class="px-1.5 py-0.5 bg-red-100 text-red-700 text-[10px] font-medium rounded truncate">Batas Lapor PPh 21</div>
                            </div>

                            {{-- Event on 20th --}}
                            <div x-show="i === 24" class="mt-1">
                                <div class="px-1.5 py-0.5 bg-yellow-100 text-yellow-700 text-[10px] font-medium rounded truncate">Batas Bayar PPN</div>
                            </div>

                            {{-- Event on 31st --}}
                            <div x-show="i === 35" class="mt-1">
                                <div class="px-1.5 py-0.5 bg-green-100 text-green-700 text-[10px] font-medium rounded truncate">Batas Lapor PPN</div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Legend --}}
            <div class="mt-6 bg-white rounded-xl shadow-sm border border-slate-200 p-4">
                <h4 class="text-sm font-semibold text-slate-700 mb-3">Keterangan</h4>
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <span class="text-xs text-slate-600">Batas Pelaporan</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <span class="text-xs text-slate-600">Batas Pembayaran</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="text-xs text-slate-600">Batas Pelaporan PPN</span>
                    </div>
                </div>
            </div>

            {{-- Upcoming Deadlines List --}}
            <div class="mt-8">
                <h3 class="font-heading font-semibold text-lg text-slate-900 mb-4">Jadwal Penting Bulan Ini</h3>
                <div class="space-y-3">
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-red-50 flex flex-col items-center justify-center text-center shrink-0">
                            <span class="text-lg font-bold text-red-600 leading-none">15</span>
                            <span class="text-[10px] text-red-500 leading-none">Jul</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-slate-900">Batas Lapor SPT Masa PPh 21</h4>
                            <p class="text-sm text-slate-500">Masa Juni 2026</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-50 text-red-600">3 hari lagi</span>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-yellow-50 flex flex-col items-center justify-center text-center shrink-0">
                            <span class="text-lg font-bold text-yellow-600 leading-none">20</span>
                            <span class="text-[10px] text-yellow-500 leading-none">Jul</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-slate-900">Batas Bayar PPN Masa</h4>
                            <p class="text-sm text-slate-500">Masa Juni 2026</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-50 text-yellow-600">8 hari lagi</span>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-green-50 flex flex-col items-center justify-center text-center shrink-0">
                            <span class="text-lg font-bold text-green-600 leading-none">31</span>
                            <span class="text-[10px] text-green-500 leading-none">Jul</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-slate-900">Batas Lapor SPT Masa PPN</h4>
                            <p class="text-sm text-slate-500">Masa Juni 2026</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-50 text-green-600">19 hari lagi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
