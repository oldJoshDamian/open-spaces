@can('view', $space)
<div onclick="@this.call('setQuery', '{{ $space->name }}').then((response) => console.log(response)).catch((error) => console.error(error))"
    class="px-3 py-2 font-semibold text-gray-800 bg-white cursor-pointer">
    {{ $space->name }}
    <div class="mt-1 text-xs font-medium text-blue-700 font-breadcrumb">Space</div>
</div>
@endif
