<x-app-layout>
    <x-slot name="header">
        <h2 class="text-base font-semibold leading-tight text-green-500 sm:text-lg">
            <a class="underline" href="{{ route('space.index') }}">{{ __('Spaces') }}</a>
            <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
            <a class="underline" href="{{ route('space.show', ['space' => $space]) }}">{{ $space->name }}</a>
            <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
            <a class="underline" href="{{ route('concept.show', ['space' => $space, 'concept' => $concept]) }}">
                {{ $concept->title }}
            </a>
            @isset($topic)
            <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
            <a class="underline"
                href="{{ route('topic.show', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) }}">
                {{ $topic->name }}
            </a>
            @endisset
            <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
            <a class="underline"
                href="{{ (isset($topic)) ? route('topic.resource.create', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) : route('concept.resource.create', ['space' => $space, 'concept' => $concept]) }}">
                {{ __('Add resource') }}
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white shadow-md sm:shadow-xl sm:p-6 sm:rounded-lg">
                <form enctype="multipart/form-data" method="POST"
                    action="{{ (isset($topic)) ? route('topic.resource.store', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) : route('concept.resource.store', ['space' => $space, 'concept' => $concept]) }}">
                    @csrf
                    @livewire('resource.type-selector')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
