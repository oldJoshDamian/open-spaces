<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold leading-tight text-green-500 text-md sm:text-lg">
                <a class="underline" href="{{ route('space.index') }}">Spaces</a>
                <i class="mx-1 text-gray-6\00 fas fa-chevron-right"></i>
                <a class="underline" href="{{ route('space.show', ['space' => $space]) }}">
                    {{ $space->name }}
                </a>
                <i class="mx-1 text-gray-6\00 fas fa-chevron-right"></i>
                <a class="underline" href="{{ route('concept.show', ['space' => $space, 'concept' => $concept]) }}">
                    {{ $concept->title }}
                </a>
                <i class="mx-1 text-gray-6\00 fas fa-chevron-right"></i>
                <a class="underline"
                    href="{{ route('topic.show', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) }}">
                    {{ $topic->name }}
                </a>
            </h2>
            <a class="hidden lg:inline"
                href="{{ route('resource.create', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) }}">
                <x-jet-button class="bg-green-500">
                    add new resource
                </x-jet-button>
            </a>
        </div>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="px-4 pt-6 lg:pt-0 md:px-0">
                    <div class="mb-4 text-lg font-bold text-green-600">
                        {{ $topic->name }}
                    </div>
                    <div class="mb-4 text-lg font-medium text-gray-700">
                        Resources
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        @foreach ($resources as $resource)
                        <a href="{{ route('topic.show', ['concept' => $concept, 'space' => $space, 'topic' => $topic]) }}"
                            class="p-3 text-lg font-semibold text-center text-green-600 bg-white shadow-md md:text-xl">
                            {{ Str::title($topic->name) }}
                        </a>
                        @endforeach
                    </div>
                    @if($resources->isEmpty())
                    <div class="text-lg font-semibold text-gray-800">
                        No resources yet! <a
                            href="{{ route('resource.create', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) }}"
                            class="text-blue-700">add
                            one.</a>
                    </div>
                    @endif
                    @if($resources->hasPages())
                    <div class="mt-4">
                        {{ $resources->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
