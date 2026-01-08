<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Games Data') }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto bg-white p-2 rounded">
        <div class="flex justify-between my-4 items-center">
            {{ $games->appends(request()->query())->links() }}
            <div class=""></div>
            <div class="flex space-x-16 mr-2">
                <form method="GET" class="flex items-center gap-2">
                    <select name="sort" onchange="this.form.submit()" class="h-8 text-sm rounded border w-24 text-left">
                        <option value="">Latest</option>
                        <option value="asc" {{ request('sort')=='asc' ? 'selected' : '' }}>
                            A-Z
                        </option>
                        <option value="desc" {{ request('sort')=='desc' ? 'selected' : '' }}>
                            Z-A
                        </option>
                    </select>
                    <input type="text" placeholder="Search..." name="search" value="{{ request('search') }}" class="h-8 text-sm rounded" autocomplete="off">
                </form>
                <a href="{{ route('games.create') }}" class="hover:bg-black/5 px-2 py-0 text-blue-600 text-3xl hover:text-blue-800">
                   +
                </a>
            </div>
        </div>
        <table class="min-w-full text-sm border">
            <thead class="bg-gray-50">
                <tr class="text-left text-gray-600">
                    <th class="px-6 py-3 border w-12">No.</th>
                    <th class="px-6 py-3 border w-48">Cover</th>
                    <th class="px-6 py-3 border">Title</th>
                    <th class="px-6 py-3 border w-32">Developer & Publisher</th>
                    <th class="px-6 py-3 border">Rating</th>
                    <th class="px-6 py-3 border">Edit/Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($games as $g)
                <tr class="border">
                    <td class="border px-6 py-3 text-center">
                        {{ $games->firstItem() + $loop->index }}.
                    </td>
                    <td class="px-6 py-3 flex justify-center">
                        <img src="{{ $g->cover ?? asset('img/placeholder_game.png') }}" alt="{{ $g->title }}" class="w-24 object-cover rounded">
                    </td>
                    <td class="border px-6 py-3 font-medium">
                        {{ $g->title }}
                    </td>
                    <td class="border px-6 py-3">
                        {{ $g->developer }} <br>
                        <span class="text-gray-500 text-xs">
                            {{ $g->publisher }}
                        </span>
                    </td>
                    <td class="border px-6 py-3 text-center">
                        {{ $g->rating ?? '-' }}/10⭐
                    </td>
                    <td class="border px-6 py-3">
                        <a href="{{ route('games.edit', $g) }}" class="text-blue-600 hover:underline">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('games.destroy', $g) }}" onsubmit="return confirm('Delete this game?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">
                                Delete
                            </button>
                        </form>
                    </td>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
{{-- <a href="{{ route('games.edit', $game) }}">Edit</a> --}}