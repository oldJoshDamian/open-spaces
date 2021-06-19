@props(['resource'])
@php
$resourceful = $resource->resourceful;
@endphp
<div class="bg-gray-100">
    @if($resourceful::class === 'App\Models\Document')
    <a class="block" href="/pdfjs-2.8.335-dist/web/viewer.html?file=/storage/{{ $resourceful->url }}@if($resourceful->specific_pages)#page={{ $resourceful->specific_pages['start_page'] }} @endif">
        <div>
            <div class="p-3">
                <img class="object-cover w-60 mx-auto h-72"
                src="/storage/{{ $resourceful->cover_page }}" alt="{{ $resourceful->title }}" />
            </div>
            <div class="text-lg p-3 bg-white font-semibold text-green-500">
                {{ $resourceful->title }}
                @if($resourceful->specific_pages)
                <div class="pt-3 text-blue-700">
                    @if($resourceful->specific_pages['start_page'])
                    <a href="/pdfjs-2.8.335-dist/web/viewer.html?file=/storage/{{ $resourceful->url }}#page={{ $resourceful->specific_pages['start_page'] }}">Page {{ $resourceful->specific_pages['start_page'] }}</a>
                    @endif
                    @if($resourceful->specific_pages['end_page'])
                    - <a href="/pdfjs-2.8.335-dist/web/viewer.html?file=/storage/{{ $resourceful->url }}#page={{ $resourceful->specific_pages['end_page'] }}">Page {{ $resourceful->specific_pages['end_page'] }}</a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </a>
    @endif
</div>