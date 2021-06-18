<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold leading-tight text-green-500">
                {{ __('Spaces') }}
            </h2>
            <a href="{{ route('space.create') }}">
                <x-jet-button class="bg-green-500">
                    create new space
                </x-jet-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div
            class="@if($spaces->count() > 0 || $discover->count() > 0) max-w-6xl @else max-w-2xl @endif mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="px-4 mb-3 text-lg font-semibold text-gray-700 md:px-6 lg:px-0">
                    Your spaces
                </div>
                <div class="grid grid-cols-1 gap-5 px-4 md:gap-6 lg:px-0 md:grid-cols-2">
                    @foreach($spaces as $space)
                    <div class="bg-white shadow-md md:rounded-md">
                        <a href="{{ route('space.show', ['space' => $space]) }}">
                            <div class="flex items-center p-4 border-b border-gray-300">
                                <div class="flex-shrink-0 mr-3">
                                    <img class="object-cover w-16 h-16 rounded-full md:w-24 md:h-24"
                                        src="{{ $space->profile_photo_url }}" alt="{{ $space->name }}" />
                                </div>
                                <div>
                                    <div class="text-xl font-medium text-gray-800">
                                        {{ $space->name }}
                                    </div>
                                    <div class="text-sm font-medium text-gray-500">
                                        {{ $space->visibility }} space
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 text-gray-700 text-md">
                                {{ $space->description ?? __('no description available') }}
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                @if($spaces->isEmpty())
                <div class="p-4 mx-4 text-lg font-semibold text-center text-gray-800 bg-gray-100 lg:mx-0">
                    No spaces yet! <a href="{{ route('space.create') }}" class="text-blue-700">create one.</a>
                </div>
                @endif
                @if($spaces->hasPages())
                <div class="mt-4">
                    {{ $spaces->links() }}
                </div>
                @endif

                @if($discover->count() > 0 || !auth()->user())
                <div class="px-4 mt-6 mb-3 text-lg font-semibold text-gray-700 lg:px-0">
                    Discover spaces
                </div>
                <div class="grid grid-cols-1 gap-5 px-4 md:gap-6 lg:px-0 md:grid-cols-2">
                    @foreach($discover as $space)
                    <div class="bg-white shadow-md md:rounded-md">
                        <a href="{{ route('space.show', ['space' => $space]) }}">
                            <div class="flex items-center p-4 border-b border-gray-300">
                                <div class="flex-shrink-0 mr-3">
                                    <img class="object-cover w-16 h-16 rounded-full md:w-24 md:h-24"
                                        src="{{ $space->profile_photo_url }}" alt="{{ $space->name }}" />
                                </div>
                                <div>
                                    <div class="text-xl font-medium text-gray-800">
                                        {{ $space->name }}
                                    </div>
                                    <div class="text-sm font-medium text-gray-500">
                                        {{ $space->visibility }} space
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 text-gray-700 text-md">
                                {{ $space->description ?? __('no description available') }}
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                @if($discover->isEmpty())
                <div class="p-4 mx-4 text-lg font-semibold text-center text-gray-800 bg-gray-100 lg:mx-0">
                    Nothing to discover yet! <a href="{{ route('space.create') }}" class="text-blue-700">create a new
                        space.</a>
                </div>
                @endif
                @if($discover->hasPages())
                <div class="mt-4">
                    {{ $discover->links() }}
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
