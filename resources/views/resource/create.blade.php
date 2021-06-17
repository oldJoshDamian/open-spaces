<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-green-500 text-md sm:text-lg">
            <a class="underline" href="{{ route('space.index') }}">{{ __('Spaces') }}</a>
            <i class="mx-1 text-gray-6\00 fas fa-chevron-right"></i>
            <a class="underline" href="{{ route('space.show', ['space' => $space]) }}">{{ $space->name }}</a>
            <i class="mx-1 text-gray-6\00 fas fa-chevron-right"></i>
            <a class="underline" href="{{ route('concept.show', ['space' => $space, 'concept' => $concept]) }}">
                {{ $concept->title }}
            </a>
            <i class="mx-1 text-gray-6\00 fas fa-chevron-right"></i>
            <a class="underline"
                href="{{ route('topic.show', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) }}">
                {{ $topic->name }}
            </a>
            <i class="mx-1 text-gray-6\00 fas fa-chevron-right"></i>
            <a class="underline"
                href="{{ route('resource.create', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) }}">
                {{ __('Add resource') }}
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white shadow-xl sm:p-6 sm:rounded-lg">
                <form method="POST" action="{{ route('space.store') }}">
                    @csrf
                    @livewire('resource.type-selector')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
