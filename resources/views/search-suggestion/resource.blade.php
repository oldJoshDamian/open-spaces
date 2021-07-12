@php
$resourceful = $resource->resourceful;
$resourceful_name = strtolower(class_basename($resourceful));
$resourceable = $resource->resourceable;
$resourceable_name = strtolower(class_basename($resourceable));
@endphp
<div onclick="@this.call('setQuery', '{{ $resource->title }}').then((response) => console.log(response)).catch((error) => console.error(error))"
    class="px-3 py-2 bg-white cursor-pointer">
    <div class="font-semibold text-gray-800">
        {{ $resource->title }}
    </div>
</div>
