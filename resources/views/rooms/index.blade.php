<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl">Salas</h2>
            <a href="{{ route('rooms.create') }}" class="px-4 py-2 rounded bg-black text-white">
                + Nova sala
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8 space-y-4">
        @forelse($rooms as $room)
            <a href="{{ route('rooms.show', $room) }}"
            class="flex items-center gap-4 border rounded-lg p-4 hover:bg-white">

                {{-- Avatar da sala --}}
                <img
                    src="{{ $room->avatar_url }}"
                    class="w-12 h-12 rounded-full object-cover"
                    alt="{{ $room->name }}"
                >

                <div>
                    <div class="font-semibold">{{ $room->name }}</div>
                    <div class="text-sm text-blue-500">
                        {{ $room->users()->count() }} membros
                    </div>
                </div>
            </a>
        @empty
            <div class="text-gray-600">
                Ainda não pertences a nenhuma sala.
            </div>
        @endforelse
    </div>

</x-app-layout>
