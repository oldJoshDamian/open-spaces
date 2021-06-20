<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 flex items-center leading-tight">
            <a class="mr-4 p-1" href="{{ route('space.show', ['space' => $space]) }}">
                <i class="fas fa-chevron-left text-blue-700"></i>
            </a>
            @livewire('space.name-label', ['spaceSlug' => $space->slug])
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('space.edit-info', ['spaceSlug' => $space->slug])
        </div>
    </div>
</x-app-layout>