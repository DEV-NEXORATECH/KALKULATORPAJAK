<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Simulasi Perbandingan Pajak') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div x-data="simulasiCalculator()" class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-heading font-semibold text-lg text-slate-900">Bandingkan Skenario</h3>
                        <button @click="tambahSkenario" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah Skenario
                        </button>
                    </div>

                    <template x-for="(skenario, index) in skenarios" :key="index">
                        <div class="mb-6 p-4 border border-slate-200 rounded-lg relative">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="font-medium text-slate-900">
                                    <span x-text="'Skenario ' + (index + 1)"></span>
                                </h4>
                                <button @click="hapusSkenario(index)" x-show="skenarios.length > 1" class="text-red-400 hover:text-red-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1">Penghasilan (Rp)</label>
                                    <input type="number" x-model="skenario.penghasilan" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm text-sm" placeholder="Penghasilan tahunan">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1">Status PTKP</label>
                                    <select x-model="skenario.ptkp_status" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm text-sm">
                                        <option value="TK0">TK/0</option>
                                        <option value="K0">K/0</option>
                                        <option value="K1">K/1</option>
                                        <option value="K2">K/2</option>
                                        <option value="K3">K/3</option>
                                    </select>
                                </div>
                                <div class="flex items-center pt-5">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" x-model="skenario.npwp" class="sr-only peer">
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                                        <span class="ml-3 text-xs text-slate-600">NPWP</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div class="mt-4">
                        <button @click="hitung" class="w-full md:w-auto px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-sm transition-colors flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed" :disabled="loading">
                            <svg x-show="loading" class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                            <span x-text="loading ? 'Menghitung...' : 'Bandingkan'"></span>
                        </button>
                    </div>
                </div>

                {{-- Comparison Table --}}
                <div x-show="results.length > 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-200">
                            <h3 class="font-heading font-semibold text-lg text-slate-900">Hasil Perbandingan</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-slate-50">
                                        <th class="text-left px-6 py-3 font-semibold text-slate-700">Parameter</th>
                                        <template x-for="(r, i) in results" :key="i">
                                            <th class="text-right px-6 py-3 font-semibold text-slate-700" x-text="r.label"></th>
                                        </template>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <tr>
                                        <td class="px-6 py-3 text-slate-500">Penghasilan</td>
                                        <template x-for="(r, i) in results" :key="i">
                                            <td class="px-6 py-3 text-right font-medium text-slate-900" x-text="formatRp(r.penghasilan)"></td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-3 text-slate-500">PTKP</td>
                                        <template x-for="(r, i) in results" :key="i">
                                            <td class="px-6 py-3 text-right font-medium text-slate-900" x-text="formatRp(r.ptkp)"></td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-3 text-slate-500">PKP</td>
                                        <template x-for="(r, i) in results" :key="i">
                                            <td class="px-6 py-3 text-right font-medium text-slate-900" x-text="formatRp(r.pkp)"></td>
                                        </template>
                                    </tr>
                                    <tr class="bg-primary-50">
                                        <td class="px-6 py-3 font-semibold text-primary-700">PPh 21 Tahunan</td>
                                        <template x-for="(r, i) in results" :key="i">
                                            <td class="px-6 py-3 text-right font-bold text-primary-600" x-text="formatRp(r.pph21_tahunan)"></td>
                                        </template>
                                    </tr>
                                    <tr class="bg-green-50">
                                        <td class="px-6 py-3 font-semibold text-green-700">PPh 21 Bulanan</td>
                                        <template x-for="(r, i) in results" :key="i">
                                            <td class="px-6 py-3 text-right font-bold text-green-600" x-text="formatRp(r.pph21_bulanan)"></td>
                                        </template>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-3 text-slate-500">Efektif Rate</td>
                                        <template x-for="(r, i) in results" :key="i">
                                            <td class="px-6 py-3 text-right font-medium text-slate-900" x-text="r.effective_rate + '%'"></td>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div x-show="rekomendasi" x-transition class="bg-green-50 border border-green-200 rounded-xl p-4 text-sm text-green-700" x-text="rekomendasi"></div>
                </div>

                <div x-show="error" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;" class="bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-700" x-text="error"></div>
            </div>
        </div>
    </div>

    <script>
        function simulasiCalculator() {
            return {
                loading: false,
                skenarios: [
                    { penghasilan: '', ptkp_status: 'TK0', npwp: true },
                    { penghasilan: '', ptkp_status: 'K2', npwp: true },
                ],
                results: [],
                calcId: null,
                error: null,
                rekomendasi: '',
                tambahSkenario() {
                    this.skenarios.push({ penghasilan: '', ptkp_status: 'TK0', npwp: true });
                },
                hapusSkenario(index) {
                    this.skenarios.splice(index, 1);
                    this.results = [];
                },
                hitung() {
                    this.loading = true;
                    this.error = null;
                    fetch('{{ route("kalkulator.simulasi.calculate") }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                        body: JSON.stringify({ scenarios: this.skenarios })
                    })
                    .then(r => r.json())
                    .then(d => {
                        if (d.success) {
                            this.results = d.result.scenarios;
                            this.rekomendasi = d.result.rekomendasi || '';
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