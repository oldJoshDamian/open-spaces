<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="mr-4 font-medium font-breadcrumb leading-wide text-blue-700 text-md sm:text-lg">
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

    <div class="py-6 md:py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden mb-20 sm:pb-16 md:mb-0">
                <div class="px-4 pt-6 sm:pt-0 sm:px-0">
                    <div class="justify-end mb-6 sm:mb-3 sm:flex">
                        <div class="flex">
                            <x-jet-input type="search" class="w-full mr-3 bg-gray-100 sm:w-96"
                                placeholder="search for resources" />
                            <x-jet-secondary-button class="text-blue-700 bg-gray-100">
                                <i class="text-md fas fa-search"></i>
                            </x-jet-secondary-button>
                        </div>
                    </div>
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