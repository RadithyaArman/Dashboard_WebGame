<aside class="w-60 min-h-screen bg-gray-900 border-r border-gray-700 text-white flex flex-col">

  <div class="p-4 border-b border-gray-700">
    <a href="{{ route('dashboard') }}">
      <h1 class="font-bold text-2xl">SUBJEK</h1>
    </a>
  </div>

  {{-- Navigasi --}}
  <nav class="flex-1 p-4 space-y-2">
    <div class="mb-2 text-sm">
      {{ __('Menu') }}
    </div>
    <a href="{{ route('dashboard') }}" class="block p-2 rounded hover:bg-gray-800 {{ request()->routeIs('dashboard') ? 'bg-gray-800' : '' }}">
      {{ __('Dashboard') }}
    </a>
    <a href="{{ route('games.index') }}" class="block p-2 rounded hover:bg-gray-800 {{ request()->routeIs('games.*') ? 'bg-gray-800' : '' }}">
      {{ __('Games') }}
    </a>
    <a href="{{ route('genres.index') }}" class="block p-2 rounded hover:bg-gray-800 {{ request()->routeIs('genres.*') ? 'bg-gray-800' : '' }}">
      {{ __('Genres') }}
    </a>
  </nav>

  {{-- User --}}
  <div class="p-4 border-t border-gray-700 space-y-2">
    <div class="mb-2 text-sm">
      {{ Auth::user()->name }}
    </div>

    <a href="{{ route('profile.edit') }}" class="block p-2 rounded hover:bg-gray-800 {{ request()->routeIs('profile.edit') ? 'bg-gray-800' : '' }}">
      {{ __('Profile Edit') }}
    </a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="w-full text-left p-2 rounded hover:bg-gray-800">
        {{ __('Logout') }}
      </button>
    </form>
  </div>

</aside>