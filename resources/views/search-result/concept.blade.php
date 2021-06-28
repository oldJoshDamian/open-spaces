@php
$space = $concept->space;
@endphp
<a href="{{ route('concept.show', ['concept' => $concept, 'space' => $space]) }}" class="self-start block md:shadow-md">
    <div class="block px-3 py-2 text-lg font-semibold text-blue-700 bg-white md:rounded-t-md">
        {{ $concept->title }}
    </div>
    <div class="px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 md:rounded-b-md font-breadcrumb">
        <span class="text-blue-700">Concept</span> <span class="text-gray-600"> in</span>
        {{ $space->name }}
    </div>
</a>
