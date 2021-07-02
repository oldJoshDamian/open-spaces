<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="mr-4 font-medium text-blue-700 capitalize leading-wide font-breadcrumb text-md sm:text-lg">
                <a class="" href="{{ route('space.index') }}">Spaces</a>
                <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
                <a class="" href="{{ route('space.show', ['space' => $space]) }}">
                    {{ $space->name }}
                </a>
                <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
                <a class="text-black">
                    {{ $concept->title }}
                </a>
            </h2>
            <div class="justify-end hidden md:flex">
                <a class="mr-6" href="{{ route('topic.create', ['space' => $space, 'concept' => $concept]) }}">
                    <x-jet-button class="bg-green-500">
                        add new topic
                    </x-jet-button>
                </a>
                <a href="{{ route('concept.resource.create', ['space' => $space, 'concept' => $concept]) }}">
                    <x-jet-secondary-button class="text-green-500 border-green-500">
                        add new resource
                    </x-jet-secondary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-20 overflow-hidden md:mb-0">
                <div class="px-4 pt-6 sm:pt-0 sm:px-0">
                    <div class="mb-3 text-lg font-bold text-gray-800">
                        Topics ({{ $topics->count() }})
                    </div>
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($topics as $topic)
                        <a href="{{ route('topic.show', ['concept' => $concept, 'space' => $space, 'topic' => $topic]) }}"
                            class="p-3 text-base font-semibold text-center text-blue-700 bg-gray-100 shadow md:text-lg">
                            {{ $topic->name }}
                        </a>
                        @endforeach
                    </div>
                    @if($topics->isEmpty())
                    <div class="text-lg font-semibold text-gray-600">
                        No topics yet! <a href="{{ route('topic.create', ['space' => $space, 'concept' => $concept]) }}"
                            class="text-blue-700">add
                            one.</a>
                    </div>
                    @endif

                </div>
                <div class="px-4 mt-10 mb-3 text-lg font-bold text-gray-700 sm:px-0">
                    Resources ({{ $resources->count() }})
                </div>
                <div class="grid grid-cols-1 gap-6 px-4 sm:gap-4 sm:px-0 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($resources as $resource)
                    <div class="self-top">
                        <x-resource.preview :resource="$resource" />
                    </div>
                    @endforeach
                </div>
                @if($resources->isEmpty())
                <div class="px-4 text-lg font-semibold text-gray-600 md:px-0">
                    No resources yet! <a
                        href="{{ route('concept.resource.create', ['space' => $space, 'concept' => $concept]) }}"
                        class="text-blue-700">add
                        one.</a>
                </div>
                @endif

            </div>

            <div
                class="fixed bottom-0 left-0 flex items-center justify-center w-full p-3 overflow-x-auto bg-gray-100 md:hidden flex-nowrap">
                <a class="mr-6" href="{{ route('topic.create', ['space' => $space, 'concept' => $concept]) }}">
                    <x-jet-button class="bg-green-500">
                        add new topic
                    </x-jet-button>
                </a>
                <a href="{{ route('concept.resource.create', ['space' => $space, 'concept' => $concept]) }}">
                    <x-jet-secondary-button class="text-green-500 border-green-500">
                        add new resource
                    </x-jet-secondary-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
