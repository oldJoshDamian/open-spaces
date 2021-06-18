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
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="text-gray-700 px-4 md:px-6 lg:px-0 text-lg mb-3 font-semibold">
                    Your spaces
                </div>
                <div class="grid grid-cols-1 gap-5 md:gap-6 px-4 lg:px-0 md:grid-cols-2">
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
                <div class="text-lg bg-gray-100 mx-4 lg:mx-0 p-4 font-semibold text-center text-gray-800">
                    No spaces yet! <a href="{{ route('space.create') }}" class="text-blue-700">create one.</a>
                </div>
                @endif
                @if($spaces->hasPages())
                <div class="mt-4">
                    {{ $spaces->links() }}
                </div>
                @endif

                @if($discover->count() > 0 || !auth()->user())
                <div class="text-gray-700 mt-6 px-4 lg:px-0 text-lg mb-3 font-semibold">
                    Discover spaces
                </div>
                <div class="grid grid-cols-1 gap-5 md:gap-6 px-4 lg:px-0 md:grid-cols-2">
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
                <div class="text-lg bg-gray-100 mx-4 lg:mx-0 p-4 font-semibold text-center text-gray-800">
                    Nothing to discover yet! <a href="{{ route('space.create') }}" class="text-blue-700">create a new space.</a>
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