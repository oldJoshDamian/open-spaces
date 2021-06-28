<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="mr-4 font-medium font-breadcrumb leading-wide text-blue-700 text-base sm:text-lg">
                <a class="" href="{{ route('space.index') }}">Spaces</a>
                <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
                <a class="text-black">
                    {{ $space->name }}
                </a>
            </h2>
            <a class="flex-shrink-0 hidden sm:inline-flex" href="{{ route('concept.create', ['space' => $space]) }}">
                <x-jet-button class="bg-green-500">
                    add new concept
                </x-jet-button>
            </a>
        </div>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col mb-20 sm:mb-0 lg:flex-row">
                <div class="h-full bg-gray-50 lg:w-80 lg:mr-4">
                    @can('update', $space)
                    <a href="{{ route('space.edit', ['space' =>$space]) }}">
                        @endcan
                        <div class="flex flex-row items-center p-4 border-b border-gray-300 md:flex-col">
                            <div class="flex-shrink-0 mr-3 md:mb-3">
                                <img class="object-cover w-16 h-16 rounded-full md:w-36 md:h-36"
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
                            class="flex justify-between px-4 py-2 text-lg font-medium text-gray-700 cursor-pointer select-none lg:cursor-auto lg:hidden">
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
                    @can('share', $space)
                    <div x-data="{ show_copy_options: false }"
                        x-init="() => { show_copy_options = (window.outerWidth > 768) ? true : false }"
                        class="py-3 font-bold text-center text-blue-700 bg-gray-300 bg-opacity-75">
                        <span x-on:click="show_copy_options = !show_copy_options;" class="text-lg select-none cursor-pointer">
                            <i class="mr-1 fas fa-share-alt"></i>
                            Share space
                        </span>
                        <div x-show="show_copy_options" class="flex pt-3 mx-4 md:mx-0">
                            <x-jet-input x-ref="link_input" type="text" class="w-full mr-2 bg-gray-100"
                                value="{{ route('space.show', ['space' => $space]) }}" />
                            <x-jet-secondary-button class="bg-gray-100">
                                <i class="text-lg text-blue-700 far fa-copy"></i>
                            </x-jet-secondary-button>
                        </div>
                    </div>
                    @endcan
                </div>
                <div class="flex-1">
                    <div class="overflow-hidden">
                        <div class="px-4 pt-7 lg:pt-0 sm:px-0">
                            <div class="justify-end mb-6 sm:flex">
                                <div class="flex">
                                    <x-jet-input type="search" class="w-full mr-3 bg-gray-100 sm:w-96"
                                        placeholder="search for concepts, topics and resources" />
                                    <x-jet-secondary-button class="text-blue-700 bg-gray-100">
                                        <i class="text-md fas fa-search"></i>
                                    </x-jet-secondary-button>
                                </div>
                            </div>
                            <div class="mb-2 text-md font-breadcrumb font-semibold">
                                Concepts ({{ $concepts->count() }})
                            </div>
                            <div class="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-3">
                                @foreach ($concepts as $concept)
                                <a href="{{ route('concept.show', ['concept' => $concept, 'space' => $space]) }}"
                                    class="p-3 text-md font-medium text-center text-blue-700 bg-white">
                                    {{ $concept->title }}
                                </a>
                                @endforeach
                            </div>
                            @if($concepts->isEmpty())
                            <div class="text-lg font-semibold text-gray-800">
                                No concepts yet! <a class="font-bold text-blue-700 underline"
                                    href="{{ route('concept.create', ['space' => $space]) }}" class="text-blue-700">add
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

            <div class="fixed bottom-0 left-0 flex items-center justify-center w-full p-3 bg-gray-100 sm:hidden">
                <a href="{{ route('concept.create', ['space' => $space]) }}">
                    <x-jet-button class="bg-green-500">
                        add new concept
                    </x-jet-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>