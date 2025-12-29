<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Games Data') }}
        </h2>
    </x-slot>

@foreach ($games as $game)
    <div>
        {{ $game->title }}
        <a href="{{ route('games.edit', $game) }}">Edit</a>
    </div>
@endforeach

</x-app-layout>
