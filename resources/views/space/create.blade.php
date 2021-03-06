<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium leading-wide font-breadcrumb text-blue-700 text-md sm:text-lg">
            <a class="" href="{{ route('space.index') }}">Spaces</a>
            <i class="mx-1 text-gray-500 fas fa-chevron-right"></i>
            <a class="text-black" href="{{ route('space.create') }}">
                {{ __('Create New Space') }}
            </a>
        </h2>
    </x-slot>

    <div class="py-4 md:py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white shadow-md sm:shadow-xl sm:p-6 sm:rounded-lg">
                <form method="POST" action="{{ route('space.store') }}" class="grid grid-cols-1 gap-4 sm:gap-6">
                    @csrf
                    <div>
                        <x-jet-label value="Name" />
                        <x-jet-input id="name" value="{{ old('space_name') }}" placeholder="name"
                            class="block w-full mt-2" type="text" name="space_name" required
                            autocomplete="space_name" />
                        <x-jet-input-error class="mt-2" for="space_name" />
                    </div>
                    <div>
                        <x-jet-label value="Visibility" />
                        <div
                            class="flex items-start p-4 mt-3 border-t border-l border-r border-gray-300 bg-blue-50 rounded-t-md">
                            <x-jet-input checked value="public" name="visibility" type="radio" />
                            <div class="ml-2 -mt-1">
                                <p class="font-semibold text-blue-700">
                                    Public
                                </p>
                                <p class="text-sm text-gray-700">
                                    Anyone can find, access and join this space.
                                </p>
                            </div>
                        </div>
                        <div
                            class="flex items-start p-4 border-t border-b border-l border-r border-gray-300 bg-blue-50 rounded-b-md">
                            <x-jet-input value="private" name="visibility" type="radio" />
                            <div class="ml-2 -mt-1">
                                <p class="font-semibold text-blue-700">
                                    Private
                                </p>
                                <p class="text-sm text-gray-700">
                                    only you can find and access this space.
                                </p>
                            </div>
                        </div>
                        <x-jet-input-error class="mt-2" for="visibility" />
                    </div>
                    <div class="text-right">
                        <x-jet-button class="bg-green-500">Create</x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>