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
                    <input type="text" placeholder="Search..." id="search" name="search" value="{{ request('search') }}" class="h-8 text-sm rounded" autocomplete="off">
                </form>
                <a href="{{ route('games.create') }}" class="hover:bg-black/5 px-2 py-0 text-blue-600 text-3xl hover:text-blue-800">
                   +
                </a>
            </div>
        </div>
        <div id="gameTable">
            @include('dashboard.games.table.tablegames')
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function () {
        let timer;

        $('#search').on('keyup', function () {
            clearTimeout(timer);
            let search = $(this).val();

            timer = setTimeout(function () {
                $.ajax({
                    url: "{{ route('games.index') }}",
                    type: "GET",
                    data: { search: search },
                    success: function (data) {
                        $('#gameTable').html(data);
                    }
                });
            }, 300);
        });
    });
</script>