@props(['resource'])
@php
$resourceful = $resource->resourceful;
@endphp
<div class="bg-gray-100">
    @switch($resourceful::class)
    @case('App\Models\Document')
    <a class="block" href="/pdfjs-2.8.335-dist/web/viewer.html?file=/storage/{{ $resourceful->url }}@if($resourceful->specific_pages)#page={{ $resourceful->specific_pages['start_page'] }} @endif">
        <div class="p-3 border-b border-gray-400">
            <div class="font-semibold text-blue-700 text-lg">
                {{ $resourceful->title }}
            </div>
        </div>
        <div>
            <div class="p-3">
                <img class="object-cover w-60 mx-auto h-72 sm:h-40 sm:w-32"
                src="/storage/{{ $resourceful->cover_page }}" alt="{{ $resourceful->title }}" />
            </div>
            <div class="text-md p-3 bg-white font-semibold text-blue-700">
                <div class="flex items-center justify-between">
                    <div class="mr-4 flex items-center flex-1">
                        <i class="fas mr-2 text-xl fa-file-pdf"></i> PDF document
                    </div>
                    <div class="text-gray-700 flex-shrink-0 font-medium text-base">
                        {{ $resourceful->created_at->diffForHumans() }}
                    </div>
                </div>
                @if($resourceful->specific_pages)
                <div class="pt-3 text-blue-700">
                    @if($resourceful->specific_pages['start_page'])
                    <a class="underline" href="/pdfjs-2.8.335-dist/web/viewer.html?file=/storage/{{ $resourceful->url }}#page={{ $resourceful->specific_pages['start_page'] }}">Page {{ $resourceful->specific_pages['start_page'] }}</a>
                    @endif
                    @if($resourceful->specific_pages['end_page'])
                    - <a class="underline" href="/pdfjs-2.8.335-dist/web/viewer.html?file=/storage/{{ $resourceful->url }}#page={{ $resourceful->specific_pages['end_page'] }}">Page {{ $resourceful->specific_pages['end_page'] }}</a>
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
            <div class="font-semibold text-blue-700 text-lg">
                {{ $resourceful->title ?? __('Untitled note') }}
            </div>
        </div>
        <p x-on:click="show_full = !show_full" :class="{ 'line-clamp-4 select-none': !show_full }" class="cursor-pointer p-3 break-words">
            {{ $resourceful->content }}
        </p>
        <div class="flex text-md p-3 bg-white font-semibold text-blue-700 items-center justify-between">
            <div class="mr-4 flex-1 flex items-center">
                <i class="fas text-xl mr-2 fa-sticky-note"></i> Note
            </div>
            <div class="text-gray-700 flex-shrink-0 font-medium text-base">
                {{ $resourceful->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
    @break
    @case('App\Models\ResourceLink')
    <div>
        <div class="p-3 border-b border-gray-400">
            <div class="font-semibold text-blue-700 text-lg">
                {{ $resourceful->title }}
            </div>
        </div>
        <p class="p-3 break-words">
            <a class="text-blue-700" href="{{ $resourceful->url }}">{{ $resourceful->url }}</a>
        </p>
        <div class="flex text-md p-3 bg-white font-semibold text-blue-700 items-center justify-between">
            <div class="mr-4 flex-1 flex items-center">
                <i class="fas text-xl mr-2 fa-link"></i> Link
            </div>
            <div class="text-gray-700 flex-shrink-0 font-medium text-base">
                {{ $resourceful->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
    @break
    @endswitch
</div>