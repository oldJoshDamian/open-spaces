@props(['resource'])
@php
$resourceful = $resource->resourceful;
@endphp
<div class="bg-gray-100">
    @switch($resourceful::class)
    @case('App\Models\Document')
    <a class="block"
        href="/pdf-reader/web/viewer.html?file=/storage/{{ $resourceful->url }}@if($resourceful->specific_pages)#page={{ $resourceful->specific_pages['start_page'] }} @endif">
        <div class="p-3 border-b border-gray-400">
            <div title="{{ $resource->title }}" class="text-lg font-semibold text-blue-700 sm:truncate">
                {{ $resource->title }}
            </div>
        </div>
        <div>
            <div class="p-3">
                <img class="object-cover mx-auto w-60 h-72 sm:h-40 sm:w-32"
                    src="/storage/{{ $resourceful->cover_page }}" alt="{{ $resource->title }}" />
            </div>
            <div class="p-3 font-semibold text-blue-700 bg-white text-md">
                <div class="flex items-center justify-between">
                    <div class="flex items-center flex-1 mr-4">
                        <i class="mr-2 text-xl fas fa-file-pdf"></i> PDF document
                    </div>
                    <div class="flex-shrink-0 text-base font-medium text-gray-700">
                        {{ $resourceful->created_at->diffForHumans() }}
                    </div>
                </div>
                @if($resourceful->specific_pages)
                <div class="pt-3 text-blue-700">
                    @if($resourceful->specific_pages['start_page'])
                    <a class="underline"
                        href="/pdf-reader/web/viewer.html?file=/storage/{{ $resourceful->url }}#page={{ $resourceful->specific_pages['start_page'] }}">Page
                        {{ $resourceful->specific_pages['start_page'] }}</a>
                    @endif
                    @if($resourceful->specific_pages['end_page'])
                    - <a class="underline"
                        href="/pdf-reader/web/viewer.html?file=/storage/{{ $resourceful->url }}#page={{ $resourceful->specific_pages['end_page'] }}">Page
                        {{ $resourceful->specific_pages['end_page'] }}</a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </a>
    @break
    @case('App\Models\PersonalNote')
    <div x-data="{ show_full: false }">
        <div class="p-3 border-b border-gray-400">
            <div class="text-lg font-semibold text-blue-700">
                {{ $resource->title ?? __('Untitled note') }}
            </div>
        </div>
        <p x-on:click="show_full = !show_full" :class="{ 'line-clamp-4 select-none': !show_full }"
            class="p-3 break-words cursor-pointer">
            {{ $resourceful->content }}
        </p>
        <div class="flex items-center justify-between p-3 font-semibold text-blue-700 bg-white text-md">
            <div class="flex items-center flex-1 mr-4">
                <i class="mr-2 text-xl fas fa-sticky-note"></i> Note
            </div>
            <div class="flex-shrink-0 text-base font-medium text-gray-700">
                {{ $resourceful->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
    @break
    @case('App\Models\ResourceLink')
    <div>
        <div class="p-3 border-b border-gray-400">
            <div class="text-lg font-semibold text-blue-700">
                {{ $resource->title }}
            </div>
        </div>
        <p class="p-3 break-words">
            <a class="text-blue-700" href="{{ $resourceful->url }}">{{ $resourceful->url }}</a>
        </p>
        <div class="flex items-center justify-between p-3 font-semibold text-blue-700 bg-white text-md">
            <div class="flex items-center flex-1 mr-4">
                <i class="mr-2 text-xl fas fa-link"></i> Link
            </div>
            <div class="flex-shrink-0 text-base font-medium text-gray-700">
                {{ $resourceful->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
    @break
    @endswitch
</div>
