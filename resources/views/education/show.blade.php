<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('education.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-heading font-semibold text-xl text-slate-900 leading-tight">
                {{ __('Edukasi Pajak') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            <article class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                {{-- Hero --}}
                <div class="h-64 bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                    <svg class="w-24 h-24 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>

                <div class="p-8">
                    {{ -- Meta --}}
                    <div class="flex items-center gap-3 mb-6">
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-primary-50 text-primary-700">PPh 21</span>
                        <span class="text-sm text-slate-400">12 Juni 2026</span>
                        <span class="text-sm text-slate-400">5 menit baca</span>
                    </div>

                    {{-- Title --}}
                    <h1 class="font-heading font-bold text-2xl md:text-3xl text-slate-900 mb-6">Panduan Lengkap PPh 21 Karyawan 2026</h1>

                    {{-- Content --}}
                    <div class="prose prose-slate max-w-none">
                        <p class="text-lg text-slate-600 leading-relaxed">Pajak Penghasilan (PPh) Pasal 21 adalah pajak atas penghasilan berupa gaji, upah, honorarium, tunjangan, dan pembayaran lain yang diterima oleh Wajib Pajak orang pribadi dalam negeri sehubungan dengan pekerjaan, jasa, atau kegiatan.</p>

                        <h2 class="font-heading font-semibold text-xl text-slate-900 mt-8 mb-4">Dasar Hukum</h2>
                        <p class="text-slate-600">Perhitungan PPh 21 tahun 2026 mengacu pada Undang-Undang Harmonisasi Peraturan Perpajakan (UU HPP) yang berlaku sejak tahun 2022. Beberapa perubahan penting meliputi:</p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-600">
                            <li>Lapisan penghasilan kena pajak (PKP) yang baru</li>
                            <li>Kenaikan PTKP untuk beberapa status</li>
                            <li>Tarif efektif untuk WP tidak memiliki NPWP lebih tinggi 20%</li>
                        </ul>

                        <h2 class="font-heading font-semibold text-xl text-slate-900 mt-8 mb-4">Langkah-Langkah Menghitung PPh 21</h2>

                        <h3 class="font-heading font-semibold text-lg text-slate-900 mt-6 mb-3">1. Tentukan Penghasilan Bruto Tahunan</h3>
                        <p class="text-slate-600">Penghasilan bruto adalah seluruh penghasilan yang diterima karyawan dalam satu tahun, termasuk gaji pokok, tunjangan tetap, tunjangan tidak tetap, dan natura yang dikenakan pajak.</p>

                        <h3 class="font-heading font-semibold text-lg text-slate-900 mt-6 mb-3">2. Kurangi dengan Biaya Jabatan dan Iuran Pensiun</h3>
                        <p class="text-slate-600">Biaya jabatan adalah 5% dari penghasilan bruto, maksimal Rp500.000 per bulan atau Rp6.000.000 per tahun. Iuran pensiun yang dibayarkan karyawan juga dapat dikurangkan.</p>

                        <h3 class="font-heading font-semibold text-lg text-slate-900 mt-6 mb-3">3. Kurangi dengan PTKP</h3>
                        <p class="text-slate-600">PTKP (Penghasilan Tidak Kena Pajak) adalah pengurangan yang diberikan berdasarkan status Wajib Pajak:</p>
                        <div class="overflow-x-auto my-4">
                            <table class="w-full text-sm border border-slate-200">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="text-left px-4 py-2 font-semibold text-slate-700">Status</th>
                                        <th class="text-right px-4 py-2 font-semibold text-slate-700">PTKP</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <tr><td class="px-4 py-2 text-slate-900">TK/0</td><td class="px-4 py-2 text-right text-slate-900">Rp 54.000.000</td></tr>
                                    <tr><td class="px-4 py-2 text-slate-900">K/0</td><td class="px-4 py-2 text-right text-slate-900">Rp 58.500.000</td></tr>
                                    <tr><td class="px-4 py-2 text-slate-900">K/1</td><td class="px-4 py-2 text-right text-slate-900">Rp 63.000.000</td></tr>
                                    <tr><td class="px-4 py-2 text-slate-900">K/2</td><td class="px-4 py-2 text-right text-slate-900">Rp 67.500.000</td></tr>
                                    <tr><td class="px-4 py-2 text-slate-900">K/3</td><td class="px-4 py-2 text-right text-slate-900">Rp 72.000.000</td></tr>
                                </tbody>
                            </table>
                        </div>

                        <h3 class="font-heading font-semibold text-lg text-slate-900 mt-6 mb-3">4. Hitung PKP dan Terapkan Tarif Progresif</h3>
                        <p class="text-slate-600">PKP (Penghasilan Kena Pajak) adalah penghasilan bruto setelah dikurangi biaya jabatan, iuran pensiun, dan PTKP. Tarif PPh 21 menggunakan tarif progresif:</p>
                        <div class="overflow-x-auto my-4">
                            <table class="w-full text-sm border border-slate-200">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="text-left px-4 py-2 font-semibold text-slate-700">Lapisan PKP</th>
                                        <th class="text-right px-4 py-2 font-semibold text-slate-700">Tarif</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <tr><td class="px-4 py-2 text-slate-900">Rp 0 - Rp 60.000.000</td><td class="px-4 py-2 text-right text-slate-900">5%</td></tr>
                                    <tr><td class="px-4 py-2 text-slate-900">Rp 60.000.000 - Rp 250.000.000</td><td class="px-4 py-2 text-right text-slate-900">15%</td></tr>
                                    <tr><td class="px-4 py-2 text-slate-900">Rp 250.000.000 - Rp 500.000.000</td><td class="px-4 py-2 text-right text-slate-900">25%</td></tr>
                                    <tr><td class="px-4 py-2 text-slate-900">&gt; Rp 500.000.000</td><td class="px-4 py-2 text-right text-slate-900">30%</td></tr>
                                </tbody>
                            </table>
                        </div>

                        <h2 class="font-heading font-semibold text-xl text-slate-900 mt-8 mb-4">Contoh Perhitungan</h2>
                        <div class="bg-slate-50 rounded-lg p-6 my-4">
                            <p class="font-medium text-slate-900 mb-3">Karyawan A (Status K/2, memiliki NPWP)</p>
                            <ul class="space-y-2 text-sm text-slate-600">
                                <li>Gaji per bulan: Rp 10.000.000</li>
                                <li>Penghasilan Bruto Tahunan: Rp 120.000.000</li>
                                <li>Biaya Jabatan (5%): Rp 6.000.000</li>
                                <li>PTKP (K/2): Rp 67.500.000</li>
                                <li>PKP: Rp 120.000.000 - Rp 6.000.000 - Rp 67.500.000 = Rp 46.500.000</li>
                                <li>PPh 21: 5% x Rp 46.500.000 = Rp 2.325.000/tahun</li>
                                <li>PPh 21 per bulan: Rp 193.750</li>
                            </ul>
                        </div>

                        <div class="bg-primary-50 rounded-lg p-6 mt-8">
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-primary-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <div>
                                    <p class="font-semibold text-primary-700 mb-1">Gunakan Kalkulator PajakKu</p>
                                    <p class="text-sm text-primary-600">Hitung PPh 21 Anda dengan mudah menggunakan kalkulator interaktif kami. Masukkan gaji dan status PTKP, dapatkan hasil instan.</p>
                                    <a href="{{ route('kalkulator.pph21') }}" class="inline-flex items-center gap-1 mt-3 text-sm font-medium text-primary-600 hover:text-primary-700">
                                        Hitung PPh 21 Sekarang
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-200">
                            <h4 class="font-heading font-semibold text-slate-900 mb-4">Bagikan Artikel</h4>
                            <div class="flex gap-3">
                                <button class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </button>
                                <button class="p-2 bg-sky-50 text-sky-600 rounded-lg hover:bg-sky-100 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                </button>
                                <button class="p-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                </button>
                                <button class="p-2 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            {{-- Related Articles --}}
            <div class="mt-8">
                <h3 class="font-heading font-semibold text-lg text-slate-900 mb-6">Artikel Terkait</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('education.show', 2) }}" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow group">
                        <div class="h-32 bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01"/></svg>
                        </div>
                        <div class="p-4">
                            <p class="text-sm font-medium text-slate-900 group-hover:text-primary-600 transition-colors">Memahami PPN 11% dan Cara Menghitungnya</p>
                            <p class="text-xs text-slate-400 mt-1">10 Jun 2026</p>
                        </div>
                    </a>
                    <a href="{{ route('education.show', 3) }}" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow group">
                        <div class="h-32 bg-gradient-to-br from-orange-500 to-orange-700 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div class="p-4">
                            <p class="text-sm font-medium text-slate-900 group-hover:text-primary-600 transition-colors">Panduan Pajak UMKM PP 23 Tahun 2018</p>
                            <p class="text-xs text-slate-400 mt-1">8 Jun 2026</p>
                        </div>
                    </a>
                    <a href="{{ route('education.show', 5) }}" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow group">
                        <div class="h-32 bg-gradient-to-br from-purple-500 to-purple-700 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="p-4">
                            <p class="text-sm font-medium text-slate-900 group-hover:text-primary-600 transition-colors">5 Strategi Optimasi Pajak yang Legal</p>
                            <p class="text-xs text-slate-400 mt-1">3 Jun 2026</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
