@php
$concept = $topic->concept;
$space = $concept->space;
@endphp
<a href="{{ route('topic.show', ['topic' => $topic, 'concept' => $concept, 'space' => $space]) }}"
    class="self-start block md:shadow-md">
    <div class="px-3 py-2 text-lg font-semibold text-blue-700 bg-white md:rounded-t-md">
        {{ $topic->name }}
    </div>
    <div class="px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 md:rounded-b-md font-breadcrumb">
        <span class="text-blue-700">Topic</span> <span class="text-gray-600"> in</span>
        {{ $space->name }} <i class="mx-1 text-gray-400 fas fa-chevron-right"></i>
        {{ $concept->title }}
    </div>
</a>
