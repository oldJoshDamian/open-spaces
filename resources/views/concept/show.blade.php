<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold mr-4 leading-tight text-green-500 text-md sm:text-lg">
                <a class="underline" href="{{ route('space.index') }}">Spaces</a>
                <i class="mx-1 text-gray-600 fas fa-chevron-right"></i>
                <a class="underline" href="{{ route('space.show', ['space' => $space]) }}">
                    {{ $space->name }}
                </a>
                <i class="mx-1 text-gray-600 fas fa-chevron-right"></i>
                <a class="underline" href="{{ route('concept.show', ['space' => $space, 'concept' => $concept]) }}">
                    {{ $concept->title }}
                </a>
            </h2>
            <a class="hidden sm:inline" href="{{ route('topic.create', ['space' => $space, 'concept' => $concept]) }}">
                <x-jet-button class="bg-green-500">
                    add new topic
                </x-jet-button>
            </a>
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
                <div class="fixed w-full sm:hidden flex justify-center flex-nowrap overflow-x-auto items-center bottom-0 bg-gray-100 p-3">
                    <a class="mr-6" href="{{ route('topic.create', ['space' => $space, 'concept' => $concept]) }}">
                        <x-jet-button class="bg-green-500">
                            add new topic
                        </x-jet-button>
                        <a
                            href="{{ route('concept.resource.create', ['space' => $space, 'concept' => $concept]) }}">
                            <x-jet-secondary-button class="border-green-500 text-green-500">
                                add new resource
                            </x-jet-secondary-button>
                        </a>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>