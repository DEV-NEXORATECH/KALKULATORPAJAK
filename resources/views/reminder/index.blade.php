<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-heading font-semibold text-xl text-slate-900 leading-tight">
                {{ __('Pengingat Pajak') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('reminder.kalender') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Kalender
                </a>
                <button @click="$dispatch('open-modal', 'add-reminder')" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Pengingat
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            {{-- Reminder List --}}
            <div class="space-y-3">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                    </div>
                    <div class="w-1 h-10 rounded-full bg-red-500"></div>
                    <div class="flex-1">
                        <h4 class="font-medium text-slate-900">Batas Lapor SPT Masa PPh 21</h4>
                        <p class="text-sm text-slate-500">15 Juli 2026 - Masa Juni 2026</p>
                        <p class="text-xs text-red-500 font-medium mt-1">3 hari lagi</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="p-1.5 text-slate-400 hover:text-primary-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <button class="p-1.5 text-slate-400 hover:text-red-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                    </div>
                    <div class="w-1 h-10 rounded-full bg-yellow-500"></div>
                    <div class="flex-1">
                        <h4 class="font-medium text-slate-900">Batas Bayar PPN Masa</h4>
                        <p class="text-sm text-slate-500">20 Juli 2026 - Masa Juni 2026</p>
                        <p class="text-xs text-yellow-600 font-medium mt-1">8 hari lagi</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="p-1.5 text-slate-400 hover:text-primary-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <button class="p-1.5 text-slate-400 hover:text-red-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                    </div>
                    <div class="w-1 h-10 rounded-full bg-green-500"></div>
                    <div class="flex-1">
                        <h4 class="font-medium text-slate-900">Batas Lapor SPT Masa PPN</h4>
                        <p class="text-sm text-slate-500">31 Juli 2026 - Masa Juni 2026</p>
                        <p class="text-xs text-green-600 font-medium mt-1">19 hari lagi</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="p-1.5 text-slate-400 hover:text-primary-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <button class="p-1.5 text-slate-400 hover:text-red-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-4 opacity-60 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-primary-600 focus:ring-primary-500" checked>
                    </div>
                    <div class="w-1 h-10 rounded-full bg-slate-300"></div>
                    <div class="flex-1">
                        <h4 class="font-medium text-slate-400 line-through">Batas Bayar PPh 21 Masa</h4>
                        <p class="text-sm text-slate-400">10 Juni 2026 - Masa Mei 2026</p>
                        <p class="text-xs text-green-500 font-medium mt-1">Selesai</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="p-1.5 text-slate-400 hover:text-primary-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <button class="p-1.5 text-slate-400 hover:text-red-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-4 opacity-60 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-primary-600 focus:ring-primary-500" checked>
                    </div>
                    <div class="w-1 h-10 rounded-full bg-slate-300"></div>
                    <div class="flex-1">
                        <h4 class="font-medium text-slate-400 line-through">Batas Lapor SPT Masa PPh 21</h4>
                        <p class="text-sm text-slate-400">15 Juni 2026 - Masa Mei 2026</p>
                        <p class="text-xs text-green-500 font-medium mt-1">Selesai</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="p-1.5 text-slate-400 hover:text-primary-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <button class="p-1.5 text-slate-400 hover:text-red-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Add Reminder Modal --}}
            <div x-data="{ open: false }" x-on:open-modal.window="if ($event.detail === 'add-reminder') open = true" x-on:keydown.escape.window="open = false" x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
                <div class="fixed inset-0 bg-slate-900/50" @click="open = false"></div>
                <div class="relative bg-white rounded-xl shadow-xl max-w-lg w-full p-6" x-on:click.stop>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-heading font-semibold text-lg text-slate-900">Tambah Pengingat Baru</h3>
                        <button @click="open = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <form>
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Judul Pengingat</label>
                                <input type="text" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm" placeholder="Contoh: Batas Bayar PPh 21">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi (Opsional)</label>
                                <textarea class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm" rows="2" placeholder="Deskripsi pengingat"></textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal</label>
                                    <input type="date" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Waktu</label>
                                    <input type="time" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                                <select class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm">
                                    <option value="pph">PPh</option>
                                    <option value="ppn">PPN</option>
                                    <option value="kendaraan">Pajak Kendaraan</option>
                                    <option value="properti">Pajak Properti</option>
                                    <option value="umum">Umum</option>
                                </select>
                            </div>
                            <div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                                    <span class="ml-3 text-sm text-slate-700">Notifikasi Aktif</span>
                                </label>
                            </div>
                        </div>
                        <div class="flex justify-end gap-3 mt-6">
                            <button type="button" @click="open = false" class="px-4 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors">Batal</button>
                            <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors">Simpan Pengingat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
