<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold leading-tight text-blue-700 mr-4 text-md sm:text-lg">
                <a class="underline" href="{{ route('space.index') }}">Spaces</a>
                <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
                <a class="underline" href="{{ route('space.show', ['space' => $space]) }}">
                    {{ $space->name }}
                </a>
                <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
                <a class="underline" href="{{ route('concept.show', ['space' => $space, 'concept' => $concept]) }}">
                    {{ $concept->title }}
                </a>
                <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
                <a class="underline"
                    href="{{ route('topic.show', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) }}">
                    {{ $topic->name }}
                </a>
            </h2>
            <a class="hidden lg:inline flex-shrink-0"
                href="{{ route('topic.resource.create', ['space' => $space, 'concept' => $concept, 'topic' => $topic]) }}">
                <x-jet-button class="bg-green-500">
                    add new resource
                </x-jet-button>
            </a>
        </div>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden mb-20 sm:mb-0">
                <div class="px-4 pt-6 lg:pt-0 md:px-0">
                    <div class="mb-4 text-xl font-bold text-green-600">
                        {{ $topic->name }}
                    </div>
                    <div class="mt-6 mb-3 font-bold text-lg">
                        Resources
                    </div>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
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
            <div class="fixed w-full sm:hidden flex justify-center items-center bottom-0 bg-gray-100 p-3">
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