<div onclick="@this.call('setQuery', '{{ $concept->title }}').then((response) => console.log(response)).catch((error) => console.error(error))"
    class="px-3 py-2 bg-white cursor-pointer">
    <div class="font-semibold text-gray-800">
        {{ $concept->title }}
    </div>
    <div class="mt-1 text-xs font-medium text-blue-700 font-breadcrumb">
        Concept <span class="text-gray-400"> in</span>
        {{ $concept->space->name }}
    </div>
</div>
