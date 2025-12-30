@php
    $start = max(1, $paginator->currentPage()-2);
    $end = min($paginator->lastPage(), $paginator->currentPage() + 2);
@endphp

@if ($paginator->hasPages())

    <nav class="mb-4">
        <ul class="flex items-center gap-1">

            {{-- Prev --}}
            @if ($paginator->onFirstPage())
                <li class="px-3 py-1 text-sm text-gray-400 border rounded">
                    <
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 text-sm border rounded hover:bg-gray-100">
                        <
                    </a>
                </li>
            @endif

            {{-- First --}}
            @if ($start > 1)
                <li>
                    <a href="{{ $paginator->url(1) }}" class="px-3 py-1 text-sm border rounded">1</a>
                </li>
                <li class="px-2">...</li>
            @endif

            {{-- Pages --}}
            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $paginator->currentPage())
                <li class="px-3 py-1 text-sm bg-blue-600 text-white rounded">
                    {{ $page }}
                </li>
                @else
                <li>
                    <a href="{{ $paginator->url($page) }}" class="px-3 py-1 text-sm border rounded hover:bg-gray-100">
                        {{ $page }}
                    </a>
                </li>
                @endif
            @endfor

            {{-- End --}}
            @if ($end < $paginator->lastPage())
                <li class="px-2">...</li>
                <li>
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="px-3 py-1 text-sm border rounded">
                        {{ $paginator->lastPage() }}
                    </a>
                </li>
            @endif

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 text-sm border rounded hover:bg-gray-100">
                        >
                    </a>
                </li>
            @else
                <li class="px-3 py-1 text-sm text-gray-400 border rounded">
                    >
                </li>
            @endif
        </ul>
    </nav>
@endif
