<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold tracking-wide text-[#0652c5] font-breadcrumb leading-wide">
                {{ __('Spaces') }}
            </h2>
            <a href="{{ route('space.create') }}">
                <x-jet-button class="bg-green-500">
                    create new space
                </x-jet-button>
            </a>
        </div>
    </x-slot>

    <div class="pb-6 md:pb-12">
        <div class="@if($spaces->count() > 0 || $discover->count() > 0) max-w-7xl @else max-w-2xl @endif mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="px-4 mb-3 text-lg font-semibold text-gray-700 sm:px-0">
                    Your spaces
                </div>
                <div>
                    <x-space.list :spaces="$spaces" />
                </div>
                @if($spaces->isEmpty())
                <div class="p-4 mx-4 text-lg font-semibold text-center text-gray-800 bg-gray-100 sm:mx-0">
                    No spaces yet! <a href="{{ route('space.create') }}" class="text-blue-700">create one.</a>
                </div>
                @endif
                @if($spaces->hasPages())
                <div class="mt-4">
                    {{ $spaces->links() }}
                </div>
                @endif

                @if($discover->count() > 0 || !auth()->user())
                <div class="px-4 mt-10 mb-3 text-lg font-semibold text-gray-700 sm:px-0">
                    Discover spaces
                </div>
                <div>
                    <x-space.list :spaces="$discover" />
                </div>
                @if($discover->isEmpty())
                <div class="p-4 mx-4 text-lg font-semibold text-center text-gray-800 bg-gray-100 sm:mx-0">
                    Nothing to discover yet! <a href="{{ route('space.create') }}" class="text-blue-700">create a new
                        space.</a>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
