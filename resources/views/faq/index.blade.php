<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-semibold text-xl text-slate-900 leading-tight">
            {{ __('FAQ - Pertanyaan Umum Seputar Pajak') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            {{-- Search --}}
            <div class="relative mb-8">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" placeholder="Cari pertanyaan..." class="w-full pl-12 pr-4 py-3 rounded-xl border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm">
            </div>

            {{-- Categories --}}
            <div class="flex flex-wrap gap-2 mb-8">
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-primary-600 text-white transition-colors">Semua</button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">PPh 21</button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">PPN</button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">UMKM</button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">Pajak Badan</button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">Pajak Daerah</button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">Pelaporan</button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">Administrasi</button>
            </div>

            {{-- FAQ Accordion --}}
            <div class="space-y-3" x-data="{ activeFaq: null }">
                {{-- FAQ 1 --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <button @click="activeFaq = activeFaq === 1 ? null : 1" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                        <span class="font-medium text-slate-900">Apa itu PPh 21 dan siapa yang wajib membayarnya?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform" :class="{'rotate-180': activeFaq === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeFaq === 1" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="px-6 pb-4" style="display: none;">
                        <p class="text-sm text-slate-600 leading-relaxed">PPh 21 adalah pajak atas penghasilan berupa gaji, upah, honorarium, tunjangan, dan pembayaran lain yang diterima oleh Wajib Pajak orang pribadi dalam negeri sehubungan dengan pekerjaan, jasa, atau kegiatan. Setiap karyawan yang memiliki penghasilan melebihi PTKP wajib membayar PPh 21.</p>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <button @click="activeFaq = activeFaq === 2 ? null : 2" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                        <span class="font-medium text-slate-900">Bagaimana cara menghitung PPh 21 karyawan?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform" :class="{'rotate-180': activeFaq === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeFaq === 2" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="px-6 pb-4" style="display: none;">
                        <p class="text-sm text-slate-600 leading-relaxed">Langkah-langkah menghitung PPh 21: (1) Hitung penghasilan bruto tahunan, (2) Kurangi biaya jabatan (5%, maks Rp6jt/tahun) dan iuran pensiun, (3) Kurangi PTKP sesuai status, (4) Hitung PKP, (5) Terapkan tarif progresif (5%-30%). Gunakan kalkulator PPh 21 kami untuk kemudahan perhitungan.</p>
                        <a href="{{ route('kalkulator.pph21') }}" class="inline-flex items-center gap-1 mt-3 text-sm font-medium text-primary-600 hover:text-primary-700">
                            Hitung PPh 21 Sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <button @click="activeFaq = activeFaq === 3 ? null : 3" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                        <span class="font-medium text-slate-900">Apa perbedaan tarif PPh Badan untuk UMKM dan perusahaan besar?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform" :class="{'rotate-180': activeFaq === 3}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeFaq === 3" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="px-6 pb-4" style="display: none;">
                        <p class="text-sm text-slate-600 leading-relaxed">UMKM dengan omzet tidak melebihi Rp4,8 miliar per tahun dapat menggunakan PP 23 dengan tarif PPh Final 0,5% dari omzet. Perusahaan dengan omzet di atas Rp4,8 miliar menggunakan tarif PPh Badan normal 22%. Perusahaan dengan omzet Rp4,8-50 miliar mendapatkan fasilitas pengurangan tarif 50% untuk PKP hingga Rp4,8 miliar.</p>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <button @click="activeFaq = activeFaq === 4 ? null : 4" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                        <span class="font-medium text-slate-900">Kapan batas waktu pelaporan SPT Tahunan?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform" :class="{'rotate-180': activeFaq === 4}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeFaq === 4" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="px-6 pb-4" style="display: none;">
                        <p class="text-sm text-slate-600 leading-relaxed">Batas waktu pelaporan SPT Tahunan adalah: (1) SPT Tahunan Orang Pribadi: paling lambat 31 Maret setiap tahun, (2) SPT Tahunan Badan: paling lambat 30 April setiap tahun. Untuk SPT Masa, batasnya adalah tanggal 20 bulan berikutnya untuk PPh dan akhir bulan berikutnya untuk PPN.</p>
                    </div>
                </div>

                {{-- FAQ 5 --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <button @click="activeFaq = activeFaq === 5 ? null : 5" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                        <span class="font-medium text-slate-900">Apa itu NPWP dan apakah wajib memilikinya?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform" :class="{'rotate-180': activeFaq === 5}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeFaq === 5" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="px-6 pb-4" style="display: none;">
                        <p class="text-sm text-slate-600 leading-relaxed">NPWP (Nomor Pokok Wajib Pajak) adalah nomor identitas Wajib Pajak. Setiap Wajib Pajak yang telah memenuhi persyaratan subjektif dan objektif wajib mendaftarkan diri untuk mendapatkan NPWP. WP tanpa NPWP akan dikenakan tarif 20% lebih tinggi untuk PPh Pasal 21 dan beberapa jenis pajak lainnya.</p>
                    </div>
                </div>

                {{-- FAQ 6 --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <button @click="activeFaq = activeFaq === 6 ? null : 6" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                        <span class="font-medium text-slate-900">Bagaimana cara menghitung PPN 11%?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform" :class="{'rotate-180': activeFaq === 6}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeFaq === 6" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="px-6 pb-4" style="display: none;">
                        <p class="text-sm text-slate-600 leading-relaxed">PPN dihitung dengan mengalikan tarif PPN (11%) dengan Dasar Pengenaan Pajak (DPP). Jika harga sudah termasuk PPN, maka DPP = (100/111) x harga. Jika belum termasuk PPN, maka PPN = 11% x harga. Contoh: Harga Rp1.000.000 belum termasuk PPN, maka PPN = Rp110.000 dan total = Rp1.110.000.</p>
                        <a href="{{ route('kalkulator.ppn') }}" class="inline-flex items-center gap-1 mt-3 text-sm font-medium text-primary-600 hover:text-primary-700">
                            Hitung PPN Sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>

                {{-- FAQ 7 --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <button @click="activeFaq = activeFaq === 7 ? null : 7" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                        <span class="font-medium text-slate-900">Apa sanksi jika terlambat membayar pajak?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform" :class="{'rotate-180': activeFaq === 7}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeFaq === 7" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="px-6 pb-4" style="display: none;">
                        <p class="text-sm text-slate-600 leading-relaxed">Sanksi keterlambatan pembayaran pajak: (1) Denda bunga 2% per bulan untuk PPh, (2) Denda PPN sebesar 2% dari jumlah yang kurang dibayar, (3) Sanksi pidana untuk pelanggaran berat. Untuk Pajak Kendaraan, denda 25% per tahun untuk PKB dan denda SWDKLLJ Rp32.000 (motor) atau Rp100.000 (mobil).</p>
                    </div>
                </div>

                {{-- FAQ 8 --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <button @click="activeFaq = activeFaq === 8 ? null : 8" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                        <span class="font-medium text-slate-900">Apakah dividen kena pajak? Bagaimana aturan terbarunya?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform" :class="{'rotate-180': activeFaq === 8}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeFaq === 8" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="px-6 pb-4" style="display: none;">
                        <p class="text-sm text-slate-600 leading-relaxed">Berdasarkan UU HPP, dividen yang diterima Wajib Pajak Dalam Negeri dapat dikecualikan dari objek pajak jika diinvestasikan di Indonesia dalam jangka waktu tertentu. Jika tidak diinvestasikan, dikenakan PPh Final sebesar 10%. Untuk WP Luar Negeri, dikenakan PPh Pasal 26 sebesar 20%.</p>
                        <a href="{{ route('kalkulator.dividen') }}" class="inline-flex items-center gap-1 mt-3 text-sm font-medium text-primary-600 hover:text-primary-700">
                            Hitung Pajak Dividen
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Still Have Questions --}}
            <div class="mt-10 bg-slate-50 rounded-xl p-8 text-center">
                <h3 class="font-heading font-semibold text-lg text-slate-900 mb-2">Masih Punya Pertanyaan?</h3>
                <p class="text-sm text-slate-500 mb-6">Tim kami siap membantu Anda dengan pertanyaan seputar perpajakan.</p>
                <button class="px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-sm transition-colors">Hubungi Kami</button>
            </div>
        </div>
    </div>
</x-app-layout>
