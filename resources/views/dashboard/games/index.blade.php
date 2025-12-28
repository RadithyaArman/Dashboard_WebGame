@foreach ($games as $game)
    <div>
        {{ $game->title }}
        <a href="{{ route('games.edit', $game) }}">Edit</a>
    </div>
@endforeach