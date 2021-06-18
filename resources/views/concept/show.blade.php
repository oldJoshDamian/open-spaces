<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="mr-4 font-semibold leading-tight text-green-500 text-md sm:text-lg">
                <a class="underline" href="{{ route('space.index') }}">Spaces</a>
                <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
                <a class="underline" href="{{ route('space.show', ['space' => $space]) }}">
                    {{ $space->name }}
                </a>
                <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
                <a class="underline" href="{{ route('concept.show', ['space' => $space, 'concept' => $concept]) }}">
                    {{ $concept->title }}
                </a>
            </h2>
            <div class="justify-end sm:flex">
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

    <div class="py-6 md:py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="px-4 pt-6 mb-11 sm:mb-0 lg:pt-0 md:px-0">
                    <div class="mb-4 text-lg font-bold text-green-600">
                        {{ $concept->title }}
                    </div>
                    <div class="mb-4 text-lg font-medium text-gray-700">
                        Topics
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        @foreach ($topics as $topic)
                        <a href="{{ route('topic.show', ['concept' => $concept, 'space' => $space, 'topic' => $topic]) }}"
                            class="p-3 text-lg font-semibold text-center text-green-600 bg-white shadow md:text-xl">
                            {{ Str::title($topic->name) }}
                        </a>
                        @endforeach
                    </div>
                    @if($topics->isEmpty())
                    <div class="text-lg font-semibold text-gray-800">
                        No topics yet! <a href="{{ route('topic.create', ['space' => $space, 'concept' => $concept]) }}"
                            class="text-blue-700">add
                            one.</a>
                    </div>
                    @endif
                    @if($topics->hasPages())
                    <div class="mt-4">
                        {{ $topics->links() }}
                    </div>
                    @endif
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($resources as $resource)
                    <div class="bg-white">

                    </div>
                    @endforeach
                </div>
                <div
                    class="fixed bottom-0 flex items-center justify-center w-full p-3 overflow-x-auto bg-gray-100 sm:hidden flex-nowrap">
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
    </div>
</x-app-layout>
