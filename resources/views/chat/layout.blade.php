<x-app-layout>
    <div class="flex h-screen bg-gray-100">

        {{-- SIDEBAR --}}
        <aside class="w-72 bg-white border-r flex flex-col">
            @include('chat.sidebar')
        </aside>

        {{-- CONTEÚDO PRINCIPAL --}}
        <main class="flex-1 flex flex-col">
            @yield('content')
        </main>

    </div>
</x-app-layout>
