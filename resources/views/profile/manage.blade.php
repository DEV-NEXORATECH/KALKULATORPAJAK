<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Profil Wajib Pajak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-heading font-semibold text-lg text-gray-700 mb-4">Tambah Profil Baru</h3>
                    <form action="{{ route('profile.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        <div>
                            <label for="npwp" class="block text-sm font-medium text-gray-700">NPWP</label>
                            <input type="text" name="npwp" id="npwp" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="text" name="nik" id="nik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        <div>
                            <label for="ptkp_status" class="block text-sm font-medium text-gray-700">Status PTKP</label>
                            <select name="ptkp_status" id="ptkp_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                <option value="TK0">TK/0 (Tidak Kawin, 0 tanggungan)</option>
                                <option value="K0">K/0 (Kawin, 0 tanggungan)</option>
                                <option value="K1">K/1 (Kawin, 1 tanggungan)</option>
                                <option value="K2">K/2 (Kawin, 2 tanggungan)</option>
                                <option value="K3">K/3 (Kawin, 3 tanggungan)</option>
                            </select>
                        </div>
                        <div>
                            <label for="pekerjaan" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        <div>
                            <label for="perusahaan" class="block text-sm font-medium text-gray-700">Perusahaan</label>
                            <input type="text" name="perusahaan" id="perusahaan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        <div class="md:col-span-2 flex items-center gap-2">
                            <input type="checkbox" name="is_default" id="is_default" value="1" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                            <label for="is_default" class="text-sm text-gray-700">Jadikan profil default</label>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" class="bg-teal-600 text-white px-6 py-2 rounded-lg hover:bg-teal-700 font-medium">
                                Simpan Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-heading font-semibold text-lg text-gray-700 mb-4">Daftar Profil</h3>
                    @forelse ($profiles as $profile)
                        <div class="border border-gray-200 rounded-lg p-4 mb-4 {{ session('active_profile_id') == $profile->id ? 'ring-2 ring-teal-500' : '' }}">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $profile->nama }}
                                        @if ($profile->is_default)
                                            <span class="ml-2 text-xs bg-teal-100 text-teal-700 px-2 py-0.5 rounded-full">Default</span>
                                        @endif
                                        @if (session('active_profile_id') == $profile->id)
                                            <span class="ml-2 text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">Aktif</span>
                                        @endif
                                    </h4>
                                    <p class="text-sm text-gray-500">
                                        NPWP: {{ $profile->npwp ?? '-' }} | NIK: {{ $profile->nik ?? '-' }} | PTKP: {{ $profile->ptkp_status ?? '-' }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if (session('active_profile_id') != $profile->id)
                                        <form action="{{ route('profile.set-active') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="profile_id" value="{{ $profile->id }}">
                                            <button type="submit" class="text-sm text-teal-600 hover:text-teal-800">Aktifkan</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('profile.destroy-profile', $profile) }}" method="POST" onsubmit="return confirm('Hapus profil ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </div>
                            </div>

                            <form action="{{ route('profile.update-profile', $profile) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3 pt-3 border-t border-gray-100">
                                @csrf
                                @method('PUT')
                                <div>
                                    <input type="text" name="nama" value="{{ $profile->nama }}" required class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                </div>
                                <div>
                                    <input type="text" name="npwp" value="{{ $profile->npwp }}" class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" placeholder="NPWP">
                                </div>
                                <div>
                                    <input type="text" name="nik" value="{{ $profile->nik }}" class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" placeholder="NIK">
                                </div>
                                <div>
                                    <select name="ptkp_status" class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                        <option value="TK0" @selected($profile->ptkp_status == 'TK0')>TK/0</option>
                                        <option value="K0" @selected($profile->ptkp_status == 'K0')>K/0</option>
                                        <option value="K1" @selected($profile->ptkp_status == 'K1')>K/1</option>
                                        <option value="K2" @selected($profile->ptkp_status == 'K2')>K/2</option>
                                        <option value="K3" @selected($profile->ptkp_status == 'K3')>K/3</option>
                                    </select>
                                </div>
                                <div>
                                    <input type="text" name="pekerjaan" value="{{ $profile->pekerjaan }}" class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" placeholder="Pekerjaan">
                                </div>
                                <div>
                                    <input type="text" name="perusahaan" value="{{ $profile->perusahaan }}" class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" placeholder="Perusahaan">
                                </div>
                                <div class="md:col-span-2 flex items-center gap-2">
                                    <input type="checkbox" name="is_default" value="1" @checked($profile->is_default) class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                                    <label class="text-sm text-gray-600">Default</label>
                                    <button type="submit" class="ml-auto text-sm bg-teal-600 text-white px-4 py-1.5 rounded hover:bg-teal-700">Update</button>
                                </div>
                            </form>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 py-8">Belum ada profil tersimpan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
