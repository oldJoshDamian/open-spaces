<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="mr-4 font-medium text-blue-700 font-breadcrumb leading-wide text-md sm:text-lg">
                <a class="" href="{{ route('space.index') }}">Spaces</a>
                <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
                <a class="" href="{{ route('space.show', ['space' => $space]) }}">
                    {{ $space->name }}
                </a>
                <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
                <a class="" href="{{ route('concept.show', ['space' => $space, 'concept' => $concept]) }}">
                    {{ $concept->title }}
                </a>
                <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
                <a class="text-black">
                    {{ $topic->name }}
                </a>
            </h2>
            <a class="flex-shrink-0 hidden lg:inline"
                href="{{ route('topic.resource.create', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) }}">
                <x-jet-button class="bg-green-500">
                    add new resource
                </x-jet-button>
            </a>
        </div>
    </x-slot>

    <div>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-20 overflow-hidden sm:pb-16 md:mb-0">
                <div class="px-4 pt-6 sm:pt-0 sm:px-0">
                    <div class="mb-4 text-xl font-bold text-blue-700">
                        {{ $topic->name }}
                    </div>
                    <div class="mt-6 mb-3 font-semibold text-md">
                        Resources ({{ $resources->count() }})
                    </div>
                    <div class="grid grid-cols-1 gap-6 sm:gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        @foreach ($resources as $resource)
                        <div class="self-top">
                            <x-resource.preview :resource="$resource" />
                        </div>
                        @endforeach
                    </div>
                    @if($resources->isEmpty())
                    <div class="text-lg font-semibold text-gray-600">
                        No resources yet! <a
                            href="{{ route('topic.resource.create', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) }}"
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
            <div class="fixed bottom-0 left-0 flex items-center justify-center w-full p-3 bg-gray-100 lg:hidden">
                <a
                    href="{{ route('topic.resource.create', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) }}">
                    <x-jet-button class="bg-green-500">
                        add new resource
                    </x-jet-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
