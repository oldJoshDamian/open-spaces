<x-app-layout>
    <x-slot name="header">
        <h2 class="flex items-center text-xl font-medium leading-tight text-gray-800 font-breadcrumb">
            <a class="p-1 mr-4" href="{{ route('space.show', ['space' => $space]) }}">
                <i class="text-blue-700 fas fa-chevron-left"></i>
            </a>
            @livewire('space.name-label', ['spaceSlug' => $space->slug])
        </h2>
    </x-slot>

    <div>
        <div class="pb-6 mx-auto -mt-2 max-w-7xl md:pb-12 sm:px-6 lg:px-8">
            @livewire('space.edit-info', ['spaceSlug' => $space->slug])
        </div>
    </div>
</x-app-layout>
