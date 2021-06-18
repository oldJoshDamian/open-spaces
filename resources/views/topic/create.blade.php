<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight text-green-500 text-md sm:text-lg">
            <a class="underline" href="{{ route('space.index') }}">{{ __('Spaces') }}</a>
            <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
            <a class="underline" href="{{ route('space.show', ['space' => $space]) }}">{{ $space->name }}</a>
            <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
            <a class="underline" href="{{ route('concept.show', ['space' => $space, 'concept' => $concept]) }}">
                {{ $concept->title }}
            </a>
            <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
            <a class="underline" href="{{ route('topic.create', ['space' => $space, 'concept' => $concept]) }}">
                {{ __('Add topic') }}
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white shadow-md sm:shadow-xl sm:p-6 sm:rounded-lg">
                <form method="POST" action="{{ route('topic.store', ['space' => $space, 'concept' => $concept]) }}"
                    class="grid grid-cols-1 gap-4 sm:gap-6">
                    @csrf
                    <div>
                        <x-jet-label value="Name" />
                        <x-jet-input id="name" value="{{ old('topic_name') }}" placeholder="name"
                            class="block w-full mt-2" type="text" name="topic_name" required
                            autocomplete="topic_name" />
                        <x-jet-input-error class="mt-2" for="topic_name" />
                    </div>
                    <div class="text-right">
                        <x-jet-button class="bg-green-500">add</x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
