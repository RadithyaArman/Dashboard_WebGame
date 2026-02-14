<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Create Genre') }}
    </h2>
  </x-slot>
  <form method="POST" action="{{ route('genres.store') }}">
    @csrf
    <div class="p-6 rounded bg-white">
      <input type="text" name="name" placeholder="Genre name" class="border p-2">
      
      <div class="flex gap-2 pt-4">
        <button type="submit"
          class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
          Save
        </button>

        <a href="{{ route('genres.index') }}"
          class="px-4 py-2 border rounded">
          Cancel
        </a>
      </div>
    </div>
  </form>
</x-app-layout>
