<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="mr-4 font-semibold leading-tight text-blue-700 text-md sm:text-lg">
                <a class="underline" href="{{ route('space.index') }}">Spaces</a>
                <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
                <a class="underline" href="{{ route('space.show', ['space' => $space]) }}">
                    {{ $space->name }}
                </a>
            </h2>
            <a class="flex-shrink-0" href="{{ route('concept.create', ['space' => $space]) }}">
                <x-jet-button class="bg-green-500">
                    add new concept
                </x-jet-button>
            </a>
        </div>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row">
                <div class="h-full bg-gray-50 lg:w-80 lg:mr-4">
                    @can('update', $space)
                    <a href="{{ route('space.edit', ['space' =>$space]) }}">
                        @endcan
                        <div class="flex flex-row items-center p-4 border-b border-gray-300 md:flex-col">
                            <div class="flex-shrink-0 mr-3 md:mb-3">
                                <img class="object-cover w-16 h-16 rounded-full md:w-28 md:h-28"
                                    src="{{ $space->profile_photo_url }}" alt="{{ $space->name }}" />
                            </div>
                            <div>
                                <div class="text-xl font-semibold text-gray-800">
                                    {{ $space->name }}
                                </div>
                                <div class="text-sm font-medium text-gray-500 md:text-center">
                                    {{ $space->visibility }} space
                                </div>
                            </div>
                        </div>
                        @can('update', $space)
                    </a>
                    @endcan
                    <div x-data="{ show_des: false }">
                        <div x-on:click="show_des = !show_des"
                            class="flex justify-between px-4 py-2 text-lg font-medium text-gray-700 cursor-pointer lg:cursor-auto lg:hidden">
                            <span>
                                Description
                            </span>
                            <span>
                                <i :class="{'fa-chevron-up': show_des, 'fa-chevron-down': !show_des }" class="fas"></i>
                            </span>
                        </div>
                        <div :class="{ 'hidden lg:block': !show_des, 'lg:block': show_des }"
                            class="p-4 text-gray-700 text-md">
                            {{ $space->description ?? __('no description available') }}
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="overflow-hidden">
                        <div class="px-4 pt-6 lg:pt-0 md:px-0">
                            <div class="mb-2 text-lg font-medium text-gray-700">
                                Concepts
                            </div>
                            <div class="grid grid-cols-2 gap-4 md:grid-cols-2 lg:grid-cols-3">
                                @foreach ($concepts as $concept)
                                <a href="{{ route('concept.show', ['concept' => $concept, 'space' => $space]) }}"
                                    class="p-3 text-lg font-semibold text-center text-blue-700 bg-white shadow-md md:text-xl">
                                    {{ $concept->title }}
                                </a>
                                @endforeach
                            </div>
                            @if($concepts->isEmpty())
                            <div class="text-lg font-semibold text-gray-800">
                                No concepts yet! <a href="{{ route('concept.create', ['space' => $space]) }}"
                                    class="text-blue-700">add
                                    one.</a>
                            </div>
                            @endif
                            @if($concepts->hasPages())
                            <div class="mt-4">
                                {{ $concepts->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
