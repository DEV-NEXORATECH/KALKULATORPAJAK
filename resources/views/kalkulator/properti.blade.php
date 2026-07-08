<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Kalkulator Pajak Properti') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            <div x-data="propertiCalculator()" class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-heading font-semibold text-lg text-slate-900 mb-6">Input Data</h3>
                    <form x-on:submit.prevent="hitung">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Transaksi</label>
                                <div class="flex gap-4 mt-2">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" x-model="form.jenis" value="jual" class="text-primary-600 focus:ring-primary-500">
                                        <span class="text-sm text-slate-700">Jual</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" x-model="form.jenis" value="sewa" class="text-primary-600 focus:ring-primary-500">
                                        <span class="text-sm text-slate-700">Sewa</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Nilai Transaksi (Rp)</label>
                                <input type="number" x-model="form.nilai_transaksi" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm" placeholder="Masukkan nilai transaksi">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Luas Tanah (m²)</label>
                                <input type="number" x-model="form.luas_tanah" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm" placeholder="100">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Luas Bangunan (m²)</label>
                                <input type="number" x-model="form.luas_bangunan" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm" placeholder="50">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">NJOP Tanah / m² (Rp)</label>
                                <input type="number" x-model="form.njop_tanah_per_m2" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm" placeholder="1000000">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">NJOP Bangunan / m² (Rp)</label>
                                <input type="number" x-model="form.njop_bangunan_per_m2" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm" placeholder="1500000">
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
                            <h3 class="font-heading font-semibold text-lg text-slate-900">Hasil Perhitungan Pajak Properti</h3>
                            <div class="flex gap-2">
                                <a x-bind:href="'/export/pdf/' + calcId" target="_blank" class="px-4 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Export PDF
                                </a>
                            </div>
                        </div>

                        <template x-if="result.jenis === 'jual'">
                            <div class="space-y-4">
                                <div class="flex justify-between py-3 border-b border-slate-100">
                                    <span class="text-sm text-slate-500">Nilai Transaksi</span>
                                    <span class="text-sm font-semibold text-slate-900" x-text="formatRp(result.nilai_transaksi)"></span>
                                </div>
                                <div class="flex justify-between py-3 border-b border-slate-100">
                                    <span class="text-sm text-slate-500">NPOP</span>
                                    <span class="text-sm font-semibold text-slate-900" x-text="formatRp(result.npop)"></span>
                                </div>
                                <div class="flex justify-between py-3 border-b border-slate-100">
                                    <span class="text-sm text-slate-500">NJOP (Tanah + Bangunan)</span>
                                    <span class="text-sm font-semibold text-slate-900" x-text="formatRp(result.njop)"></span>
                                </div>
                                <div class="flex justify-between py-3 border-b border-slate-100">
                                    <span class="text-sm text-slate-500">BPHTB (5%)</span>
                                    <span class="text-lg font-bold text-primary-600" x-text="formatRp(result.bphtb)"></span>
                                </div>
                                <div class="flex justify-between py-3">
                                    <span class="text-sm text-slate-500">PBB (estimasi)</span>
                                    <span class="text-lg font-bold text-green-500" x-text="formatRp(result.pbb)"></span>
                                </div>
                                <div class="flex justify-between py-3">
                                    <span class="text-sm text-slate-500">PPh Final Penjual</span>
                                    <span class="text-lg font-bold text-primary-600" x-text="formatRp(result.pph_final_penjual)"></span>
                                </div>
                                <div class="mt-4 bg-slate-50 rounded-lg p-4">
                                    <h4 class="text-sm font-semibold text-slate-700 mb-2">Detail Perhitungan</h4>
                                    <div class="text-xs text-slate-500 space-y-1">
                                        <p>NJOP = Tanah + Bangunan = <span x-text="formatRp(result.njop)"></span></p>
                                        <p>BPHTB = 5% x (NPOP - NPOPTKP) = <span x-text="formatRp(result.bphtb)"></span></p>
                                        <p>PPh Final Penjual = 2.5% x Nilai Transaksi = <span x-text="formatRp(result.pph_final_penjual)"></span></p>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <template x-if="result.jenis === 'sewa'">
                            <div class="space-y-4">
                                <div class="flex justify-between py-3 border-b border-slate-100">
                                    <span class="text-sm text-slate-500">Nilai Sewa</span>
                                    <span class="text-sm font-semibold text-slate-900" x-text="formatRp(result.nilai_sewa)"></span>
                                </div>
                                <div class="flex justify-between py-3 border-b border-slate-100">
                                    <span class="text-sm text-slate-500">PPh Final Sewa (10%)</span>
                                    <span class="text-lg font-bold text-primary-600" x-text="formatRp(result.pph_final)"></span>
                                </div>
                                <div class="flex justify-between py-3 border-b border-slate-100">
                                    <span class="text-sm text-slate-500">PPN (11%)</span>
                                    <span class="text-lg font-bold text-primary-600" x-text="formatRp(result.ppn)"></span>
                                </div>
                                <div class="flex justify-between py-3">
                                    <span class="text-sm text-slate-500">Total Pembayaran</span>
                                    <span class="text-lg font-bold text-green-500" x-text="formatRp(result.total)"></span>
                                </div>
                                <div class="mt-4 bg-slate-50 rounded-lg p-4">
                                    <h4 class="text-sm font-semibold text-slate-700 mb-2">Detail Perhitungan</h4>
                                    <div class="text-xs text-slate-500 space-y-1">
                                        <p>PPh Final = 10% x Nilai Sewa</p>
                                        <p>PPN = 11% x Nilai Sewa</p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="error" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;" class="bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-700" x-text="error"></div>
            </div>
        </div>
    </div>

    <script>
        function propertiCalculator() {
            return {
                loading: false,
                form: { jenis: 'jual', nilai_transaksi: '', luas_tanah: '', luas_bangunan: '', njop_tanah_per_m2: '', njop_bangunan_per_m2: '' },
                result: null,
                calcId: null,
                error: null,
                hitung() {
                    this.loading = true;
                    this.error = null;
                    fetch('{{ route("kalkulator.properti.calculate") }}', {
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