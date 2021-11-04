<x-app-layout>
    <x-slot name="header">
        <h2 class="text-base font-medium text-blue-700 leading-wide font-breadcrumb sm:text-lg">
            <a class="" href="{{ route('space.index') }}">{{ __('Spaces') }}</a>
            <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
            <a class="" href="{{ route('space.show', ['space' => $space]) }}">{{ $space->name }}</a>
            <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
            <a class="" href="{{ route('concept.show', ['space' => $space, 'concept' => $concept]) }}">
                {{ $concept->title }}
            </a>
            @isset($topic)
            <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
            <a class="" href="{{ route('topic.show', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) }}">
                {{ $topic->name }}
            </a>
            @endisset
            <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
            <a class="text-black">
                {{ __('Add resource') }}
            </a>
        </h2>
    </x-slot>

    <div class="py-4 md:py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white shadow-md sm:shadow-xl sm:p-6 sm:rounded-lg">
                <form enctype="multipart/form-data" method="POST" action="{{ (isset($topic)) ? route('topic.resource.store', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) : route('concept.resource.store', ['space' => $space, 'concept' => $concept]) }}">
                    @csrf
                    @livewire('resource.type-selector', ['resource_type' => old('resource_type') ?? 'new_file'])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
