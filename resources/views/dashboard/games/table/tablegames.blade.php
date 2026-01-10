<table class="min-w-full text-sm border table-fixed">
    <thead class="bg-gray-50">
        <tr class="text-left text-gray-600">
            <th class="px-6 py-3 border w-12">No.</th>
            <th class="px-6 py-3 border w-48">Cover</th>
            <th class="px-6 py-3 border">Title</th>
            <th class="px-6 py-3 border w-44">Developer & Publisher</th>
            <th class="px-6 py-3 border w-24">Rating</th>
            <th class="px-6 py-3 border min-w-36 max-w-36">Genre</th>
            <th class="px-6 py-3 border w-32">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($games as $g)
        <tr class="border">
            <td class="border px-6 py-3 text-center">
                {{ $games->firstItem() + $loop->index }}.
            </td>
            <td class="px-6 py-3 align-middle">
                <img src="{{ $g->cover ?? asset('img/placeholder_game.png') }}" alt="{{ $g->title }}" class="w-24 object-cover rounded mx-auto">
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
                <ul class="flex flex-wrap gap-2">
                    @foreach ($g->genres as $genre)
                        <li class="px-2 py-1 rounded text-xs bg-gray-200 text-nowrap">
                            {{ $genre->name }}
                        </li>
                    @endforeach
                </ul>
                
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