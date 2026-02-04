<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Genres Data') }}
    </h2>
  </x-slot>
  <div class="overflow-x-auto bg-white p-2 rounded">
    <div class="flex justify-between my-1 items-center">
      {{ $genres->appends(request()->query())->links() }}
      <div class=""></div>
      <div class="flex space-x-16 mr-2">
        <a href="{{ route('genres.create') }}" class="hover:bg-black/5 px-2 py-0 text-blue-600 text-3xl hover:text-blue-800">
            +
        </a>
      </div>
    </div>
    @if(session('success'))
      <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-3">
          {{ session('success') }}
      </div>
    @endif
    @if(session('error'))
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-3">
          {{ session('error') }}
      </div>
    @endif
    <table class="min-w-full text-sm border table-fixed">
      <tr class="bg-gray-50">
        <th class="p-2">Name</th>
        <th>Games Count</th>
        <th>Action</th>
      </tr>
      @foreach($genres as $genre)
      <tr class="border-t">
        <td class="p-2">{{ $genre->name }}</td>
        <td class="text-center">{{ $genre->games_count }}</td>
        <td>
          <a href="{{ route('genres.edit', $genre) }}" class="text-blue-600">Edit</a>
          <form method="POST" action="{{ route('genres.destroy', $genre) }}">
              @csrf
              @method('DELETE')
              <button onclick="return confirm('Hapus?')" class="text-red-600">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>




</x-app-layout>