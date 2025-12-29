<div class="h-full flex flex-col">

    {{-- UTILIZADOR --}}
    <div class="px-4 py-4 border-b">
        <div class="font-semibold">{{ auth()->user()->name }}</div>
        <div class="text-xs text-gray-500">
            {{ auth()->user()->role === 'admin' ? 'Admin' : 'User' }}
        </div>
    </div>

    {{-- SALAS --}}
    <div class="px-4 py-3">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-semibold text-gray-500 uppercase">Salas</span>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('rooms.create') }}"
                   class="text-xs text-blue-600 hover:underline">
                    + Nova
                </a>
            @endif
        </div>

        <div class="space-y-1">
            @foreach(auth()->user()->rooms as $room)
                <a href="{{ route('rooms.show', $room) }}"
                   class="block px-2 py-1 rounded text-sm hover:bg-gray-100
                   {{ request()->routeIs('rooms.show') && request()->route('room')?->id === $room->id ? 'bg-gray-200 font-semibold' : '' }}">
                    # {{ $room->name }}
                </a>
            @endforeach
            <div class="mt-6">
                <a href="{{ route('rooms.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium
                        text-gray-700 bg-white border border-gray-300 rounded-lg
                        hover:bg-gray-100 transition">
                    ← Voltar
                </a>
            </div>
        </div>
    </div>

    {{-- MENSAGENS DIRETAS --}}
    <div class="px-4 py-3 border-t mt-auto">
        <span class="text-xs font-semibold text-gray-500 uppercase block mb-2">
            Mensagens diretas
        </span>

        <div class="space-y-1">
            @foreach(\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                <a href="{{ route('messages.direct.show', $user) }}"
                class="flex items-center gap-2 px-2 py-1 rounded text-sm hover:bg-gray-100">

                    {{-- Estado --}}
                    <span class="w-2 h-2 rounded-full
                        {{ $user->status === 'online' ? 'bg-green-500' : 'bg-gray-400' }}">
                    </span>

                    {{-- Nome --}}
                    <span>{{ $user->name }}</span>
                </a>
            @endforeach
        </div>
    </div>

</div>
