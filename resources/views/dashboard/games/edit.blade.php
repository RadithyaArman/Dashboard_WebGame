<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Edit Game') }}
    </h2>
  </x-slot>

  <form method="POST" action="{{ route('games.update', $game) }}" enctype="multipart/form-data" class="">
    @csrf
    @method('PUT')
    <div class="p-6 rounded bg-white space-y-4">
      <div class="">
        <label>Title :</label>
        <input type="text" name="title" value="{{ old('title', $game->title) }}" class="w-full border rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm @error('title') border-red-500 @enderror">
        @error('title')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="">
        <label>Description :</label>
        <textarea name="description" rows="4" class="w-full border rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm @error('description') border-red-500 @enderror">{{ old('description', $game->description) }}</textarea>
        @error('description')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="">
        <label>Developer :</label>
        <input type="text" name="developer" value="{{ old('developer', $game->developer) }}" class="w-full border rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm @error('developer') border-red-500 @enderror">
        @error('developer')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="">
        <label>Publisher :</label>
        <input type="text" name="publisher" value="{{ old('publisher', $game->publisher) }}" class="w-full border rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm @error('publisher') border-red-500 @enderror">
        @error('publisher')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="">
        <label>Rating :</label>
        <input type="number" step="0.1" name="rating" value="{{ old('rating', $game->rating) }}" class="w-full border rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm @error('rating') border-red-500 @enderror">
        @error('rating')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="">
         <label>Genre :</label>
          <div class="grid grid-cols-2 gap-2">
            @foreach ($genres as $genre)
              <label class="flex items-center gap-2 text-sm w-fit cursor-pointer">
                <input type="checkbox"
                  name="genres[]"
                  value="{{ $genre->id }}"
                  {{ in_array($genre->id, old('genres', $game->genres->pluck('id')->toArray())) ? 'checked' : '' }}>
                {{ $genre->name }}
              </label>
            @endforeach
            
            @error('genres')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror

            @error('genres.*')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>
      </div>

      <div class="">
        <label>Cover :</label>
        <input type="url" name="cover" value="{{ old('cover', $game->cover) }}" class="w-full border rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
      </div>

      <div class="flex gap-2 pt-4">
        <button type="submit"
          class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
          Save
        </button>

        <a href="{{ route('games.index') }}"
          class="px-4 py-2 border rounded">
          Cancel
        </a>
      </div>
    </div>
  </form>

  

</x-app-layout>