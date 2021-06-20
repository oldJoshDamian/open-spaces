<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="mr-4 font-semibold leading-tight text-blue-700 text-md sm:text-lg">
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
            <div class="justify-end hidden sm:flex">
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
            <div class="overflow-hidden mb-20 sm:mb-0">
                <div class="px-4 pt-6 lg:pt-0 md:px-0">
                    <div class="mb-3 font-bold text-xl text-black">
                        Topics
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        @foreach ($topics as $topic)
                        <a href="{{ route('topic.show', ['concept' => $concept, 'space' => $space, 'topic' => $topic]) }}"
                            class="p-3 text-base font-semibold text-center text-blue-700 shadow bg-gray-100 md:text-xl">
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
                <div class="mt-10 px-4 md:px-0 mb-3 font-bold text-black text-xl">
                    Resources
                </div>
                <div class="grid grid-cols-1 px-4 md:px-0 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($resources as $resource)
                    <div class="self-top">
                        <x-resource.preview :resource="$resource" />
                    </div>
                    @endforeach
                </div>
                @if($resources->isEmpty())
                <div class="text-lg px-4 font-semibold text-gray-600">
                    No resources yet! <a
                        href="{{ route('concept.resource.create', ['space' => $space, 'concept' => $concept]) }}"
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
</x-app-layout>