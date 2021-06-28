<div onclick="@this.call('setQuery', '{{ $topic->name }}').then((response) => console.log(response)).catch((error) => console.error(error))"
    class="px-3 py-2 bg-white cursor-pointer">
    <div class="font-semibold text-gray-800">
        {{ $topic->name }}
    </div>
    <div class="mt-1 text-xs font-medium text-blue-700 font-breadcrumb">
        Topic <span class="text-gray-400"> in</span>
        {{ $topic->concept->space->name }} <i class="mx-1 text-gray-400 fas fa-chevron-right"></i>
        {{ $topic->concept->title }}
    </div>
</div>
