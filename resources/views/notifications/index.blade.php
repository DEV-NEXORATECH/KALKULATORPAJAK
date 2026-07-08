<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-heading font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Notifikasi') }}
            </h2>
            @if ($notifications->where('is_read', false)->count() > 0)
                <form action="{{ route('notifications.read-all') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-teal-600 hover:text-teal-800 font-medium">
                        Tandai Semua Dibaca
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse ($notifications as $notification)
                        <div class="flex items-start gap-4 p-4 {{ !$notification->is_read ? 'bg-teal-50 border-l-4 border-teal-500' : 'border-b border-gray-100' }} rounded-lg mb-2">
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="font-semibold {{ !$notification->is_read ? 'text-teal-800' : 'text-gray-700' }}">
                                        {{ $notification->judul }}
                                    </h3>
                                    <span class="text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">{{ $notification->isi }}</p>
                                @if ($notification->link)
                                    <a href="{{ $notification->link }}" class="text-sm text-teal-600 hover:text-teal-800 mt-1 inline-block">
                                        Lihat Detail &rarr;
                                    </a>
                                @endif
                            </div>
                            @if (!$notification->is_read)
                                <form action="{{ route('notifications.read', $notification) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xs text-gray-400 hover:text-teal-600" title="Tandai dibaca">
                                        &#10003;
                                    </button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <p>Tidak ada notifikasi</p>
                        </div>
                    @endforelse

                    <div class="mt-6">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
