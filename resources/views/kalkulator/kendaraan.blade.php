<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Kalkulator Pajak Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            <div x-data="kendaraanCalculator()" class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-heading font-semibold text-lg text-slate-900 mb-6">Input Data</h3>
                    <form x-on:submit.prevent="hitung">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Kendaraan</label>
                                <div class="flex gap-4 mt-2">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" x-model="form.jenis" value="motor" class="text-primary-600 focus:ring-primary-500">
                                        <span class="text-sm text-slate-700">Motor</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" x-model="form.jenis" value="mobil" class="text-primary-600 focus:ring-primary-500">
                                        <span class="text-sm text-slate-700">Mobil</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Tahun Kendaraan</label>
                                <input type="number" x-model="form.tahun_kendaraan" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm" placeholder="2020">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Nilai Jual (Rp)</label>
                                <input type="number" x-model="form.nilai_jual" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm" placeholder="Masukkan nilai jual kendaraan">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">PKB Sebelumnya (Rp)</label>
                                <input type="number" x-model="form.pkb_sebelumnya" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm" placeholder="Masukkan PKB tahun lalu">
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
                            <h3 class="font-heading font-semibold text-lg text-slate-900">Hasil Perhitungan Pajak Kendaraan</h3>
                            <div class="flex gap-2">
                                <a x-bind:href="'/export/pdf/' + calcId" target="_blank" class="px-4 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Export PDF
                                </a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex justify-between py-3 border-b border-slate-100">
                                    <span class="text-sm text-slate-500">PKB</span>
                                    <span class="text-sm font-semibold text-slate-900" x-text="formatRp(result.pkb)"></span>
                                </div>
                                <div class="flex justify-between py-3 border-b border-slate-100">
                                    <span class="text-sm text-slate-500">SWDKLLJ</span>
                                    <span class="text-sm font-semibold text-slate-900" x-text="formatRp(result.swdkllj)"></span>
                                </div>
                                <div class="flex justify-between py-3 border-b border-slate-100">
                                    <span class="text-sm text-slate-500">Total Pajak</span>
                                    <span class="text-base font-bold text-primary-600" x-text="formatRp(result.total_pajak)"></span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <template x-if="result.denda > 0">
                                    <div class="flex justify-between py-3 border-b border-slate-100">
                                        <span class="text-sm text-slate-500">Denda (Telat)</span>
                                        <span class="text-sm font-semibold text-red-500" x-text="formatRp(result.denda)"></span>
                                    </div>
                                </template>
                                <div class="flex justify-between py-3">
                                    <span class="text-base font-semibold text-slate-900">Total Keseluruhan</span>
                                    <span class="text-lg font-bold text-green-500" x-text="formatRp(result.total_keseluruhan)"></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 bg-slate-50 rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full" :class="result.denda > 0 ? 'bg-red-500' : 'bg-green-500'"></div>
                                <span class="text-sm text-slate-600" x-text="result.denda > 0 ? 'Kendaraan Anda telat membayar pajak. Segera lakukan pembayaran untuk menghindari denda lebih besar.' : 'Pajak kendaraan Anda masih aktif.'"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="error" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;" class="bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-700" x-text="error"></div>
            </div>
        </div>
    </div>

    <script>
        function kendaraanCalculator() {
            return {
                loading: false,
                form: { jenis: 'motor', tahun_kendaraan: new Date().getFullYear(), nilai_jual: '', pkb_sebelumnya: '' },
                result: null,
                calcId: null,
                error: null,
                hitung() {
                    this.loading = true;
                    this.error = null;
                    fetch('{{ route("kalkulator.kendaraan.calculate") }}', {
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