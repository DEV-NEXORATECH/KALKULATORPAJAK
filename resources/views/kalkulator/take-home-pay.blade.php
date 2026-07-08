<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Kalkulator Take Home Pay') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            <div x-data="thpCalculator()" class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-heading font-semibold text-lg text-slate-900 mb-6">Input Data</h3>
                    <form x-on:submit.prevent="hitung">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Gaji Bulanan (Rp)</label>
                                <input type="number" x-model="form.gaji_bulanan" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm" placeholder="Masukkan gaji bulanan">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Status PTKP</label>
                                <select x-model="form.ptkp_status" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm">
                                    <option value="TK0">TK/0</option>
                                    <option value="K0">K/0</option>
                                    <option value="K1">K/1</option>
                                    <option value="K2">K/2</option>
                                    <option value="K3">K/3</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">NPWP</label>
                                <div class="flex items-center gap-3 mt-2">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" x-model="form.npwp" class="sr-only peer">
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                                        <span class="ml-3 text-sm text-slate-600" x-text="form.npwp ? 'Memiliki NPWP' : 'Tidak Memiliki NPWP'"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" x-model="form.bpjs_kesehatan" class="sr-only peer">
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                                        <span class="ml-3 text-sm font-medium text-slate-700">BPJS Kesehatan</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" x-model="form.bpjs_ketenagakerjaan" class="sr-only peer">
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                                        <span class="ml-3 text-sm font-medium text-slate-700">BPJS Ketenagakerjaan</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="w-full md:w-auto px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-sm transition-colors flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed" :disabled="loading">
                                <svg x-show="loading" class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                                <span x-text="loading ? 'Menghitung...' : 'Hitung'"></span>
                            </button>
                        </div>
                    </form>
                </div>

                <div x-show="result" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-heading font-semibold text-lg text-slate-900">Take Home Pay</h3>
                            <div class="flex gap-2">
                                <a x-bind:href="'/export/pdf/' + calcId" target="_blank" class="px-4 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Export PDF
                                </a>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex justify-between py-3 border-b border-slate-100">
                                <span class="text-sm text-slate-500">Gaji Bulanan</span>
                                <span class="text-sm font-semibold text-slate-900" x-text="formatRp(result.gaji_bulanan)"></span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-slate-100">
                                <span class="text-sm text-slate-500">Potongan PPh 21</span>
                                <span class="text-sm font-semibold text-red-500" x-text="'- ' + formatRp(result.potongan_pph21)"></span>
                            </div>
                            <template x-if="result.potongan_bpjs_kesehatan > 0">
                                <div class="flex justify-between py-3 border-b border-slate-100">
                                    <span class="text-sm text-slate-500">Potongan BPJS Kesehatan</span>
                                    <span class="text-sm font-semibold text-red-500" x-text="'- ' + formatRp(result.potongan_bpjs_kesehatan)"></span>
                                </div>
                            </template>
                            <template x-if="result.potongan_bpjs_ketenagakerjaan > 0">
                                <div class="flex justify-between py-3 border-b border-slate-100">
                                    <span class="text-sm text-slate-500">Potongan BPJS Ketenagakerjaan</span>
                                    <span class="text-sm font-semibold text-red-500" x-text="'- ' + formatRp(result.potongan_bpjs_ketenagakerjaan)"></span>
                                </div>
                            </template>
                            <div class="flex justify-between py-3">
                                <span class="text-lg font-semibold text-slate-900">Take Home Pay</span>
                                <span class="text-lg font-bold text-green-500" x-text="formatRp(result.take_home_pay)"></span>
                            </div>
                        </div>

                        <div class="mt-6 bg-slate-50 rounded-lg p-4">
                            <h4 class="text-sm font-semibold text-slate-700 mb-3">Ringkasan</h4>
                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div class="bg-white rounded-lg p-3 border border-slate-200">
                                    <p class="text-xs text-slate-500">Total Potongan</p>
                                    <p class="text-lg font-bold text-red-500" x-text="formatRp(result.total_potongan)"></p>
                                </div>
                                <div class="bg-white rounded-lg p-3 border border-slate-200">
                                    <p class="text-xs text-slate-500">Persentase Potongan</p>
                                    <p class="text-lg font-bold text-slate-700" x-text="(result.gaji_bulanan > 0 ? ((result.total_potongan / result.gaji_bulanan) * 100).toFixed(1) : 0) + '%'"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="error" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;" class="bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-700" x-text="error"></div>
            </div>
        </div>
    </div>

    <script>
        function thpCalculator() {
            return {
                loading: false,
                form: {
                    gaji_bulanan: '',
                    ptkp_status: 'TK0',
                    npwp: true,
                    bpjs_kesehatan: false,
                    bpjs_ketenagakerjaan: false
                },
                result: null,
                calcId: null,
                error: null,
                hitung() {
                    this.loading = true;
                    this.error = null;
                    fetch('{{ route("kalkulator.take-home-pay.calculate") }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                        body: JSON.stringify(this.form)
                    })
                    .then(r => r.json())
                    .then(d => {
                        if (d.success) {
                            this.result = d.result;
                            this.calcId = d.calculation_id;
                        } else {
                            this.error = 'Terjadi kesalahan perhitungan';
                        }
                    })
                    .catch(() => { this.error = 'Gagal menghubungi server'; })
                    .finally(() => { this.loading = false; });
                },
                formatRp(val) { return 'Rp ' + Math.round(val).toLocaleString('id-ID'); }
            }
        }
    </script>
</x-app-layout>