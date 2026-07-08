<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('history.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/></svg>
                </a>
                <h2 class="font-heading font-semibold text-xl text-slate-900 leading-tight">
                    {{ __('Detail Perhitungan') }}
                </h2>
            </div>
            <span class="px-3 py-1 text-xs font-medium rounded-full bg-primary-50 text-primary-700">PPh 21 Karyawan</span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            {{-- Meta Info --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="font-heading font-semibold text-lg text-slate-900">Perhitungan Gaji Tahunan</h3>
                        <p class="text-sm text-slate-500 mt-1">Dibuat pada 12 Juni 2026, 14:30 WIB</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <button class="px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Export PDF
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Export Excel
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                            Share
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-lg transition-colors flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Input Parameters --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-heading font-semibold text-lg text-slate-900 mb-4">Parameter Input</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between py-2 border-b border-slate-100">
                            <span class="text-sm text-slate-500">Penghasilan Bruto Tahunan</span>
                            <span class="text-sm font-semibold text-slate-900">Rp 120.000.000</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-slate-100">
                            <span class="text-sm text-slate-500">Status PTKP</span>
                            <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-slate-100 text-slate-700">K/2</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-slate-100">
                            <span class="text-sm text-slate-500">NPWP</span>
                            <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-700">Memiliki NPWP</span>
                        </div>
                    </div>
                </div>

                {{-- Results --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-heading font-semibold text-lg text-slate-900 mb-4">Hasil Perhitungan</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between py-2 border-b border-slate-100">
                            <span class="text-sm text-slate-500">Penghasilan Bruto</span>
                            <span class="text-sm font-semibold text-slate-900">Rp 120.000.000</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-slate-100">
                            <span class="text-sm text-slate-500">PTKP</span>
                            <span class="text-sm font-semibold text-slate-900">Rp 67.500.000</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-slate-100">
                            <span class="text-sm text-slate-500">PKP</span>
                            <span class="text-sm font-semibold text-slate-900">Rp 52.500.000</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-slate-100">
                            <span class="text-sm text-slate-500">PPh 21 Tahunan</span>
                            <span class="text-base font-bold text-primary-600">Rp 2.450.000</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-sm text-slate-500">PPh 21 Bulanan</span>
                            <span class="text-base font-bold text-green-500">Rp 204.167</span>
                        </div>
                    </div>
                </div>

                {{-- Layer Details --}}
                <div class="md:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-heading font-semibold text-lg text-slate-900 mb-4">Rincian Lapisan Pajak</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-slate-50">
                                    <th class="text-left px-4 py-3 font-semibold text-slate-700">Lapisan</th>
                                    <th class="text-right px-4 py-3 font-semibold text-slate-700">Dasar Pengenaan Pajak</th>
                                    <th class="text-right px-4 py-3 font-semibold text-slate-700">Tarif</th>
                                    <th class="text-right px-4 py-3 font-semibold text-slate-700">Pajak</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <tr>
                                    <td class="px-4 py-3 text-slate-900">5% x Rp 0 - Rp 60jt</td>
                                    <td class="px-4 py-3 text-right text-slate-900">Rp 52.500.000</td>
                                    <td class="px-4 py-3 text-right text-slate-900">5%</td>
                                    <td class="px-4 py-3 text-right font-semibold text-slate-900">Rp 2.625.000</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 text-slate-500">15% x Rp 60jt - Rp 250jt</td>
                                    <td class="px-4 py-3 text-right text-slate-500">Rp 0</td>
                                    <td class="px-4 py-3 text-right text-slate-500">15%</td>
                                    <td class="px-4 py-3 text-right text-slate-500">Rp 0</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 text-slate-500">25% x Rp 250jt - Rp 500jt</td>
                                    <td class="px-4 py-3 text-right text-slate-500">Rp 0</td>
                                    <td class="px-4 py-3 text-right text-slate-500">25%</td>
                                    <td class="px-4 py-3 text-right text-slate-500">Rp 0</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 text-slate-500">30% x > Rp 500jt</td>
                                    <td class="px-4 py-3 text-right text-slate-500">Rp 0</td>
                                    <td class="px-4 py-3 text-right text-slate-500">30%</td>
                                    <td class="px-4 py-3 text-right text-slate-500">Rp 0</td>
                                </tr>
                                <tr class="bg-primary-50">
                                    <td class="px-4 py-3 font-semibold text-primary-700">Total</td>
                                    <td class="px-4 py-3 text-right"></td>
                                    <td class="px-4 py-3 text-right"></td>
                                    <td class="px-4 py-3 text-right font-bold text-primary-600">Rp 2.625.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
