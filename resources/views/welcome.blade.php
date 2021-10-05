<x-app-layout>
    <div>
        <div class="bg-green-600">
            <div
                class="max-w-6xl mx-auto font-bold leading-normal tracking-wide text-white bg-green-600 md:pt-14 md:pb-6 font-header">
                <div class="text-3xl px-4 py-8 sm:px-6 lg:px-8 md:text-4xl">
                    Store, Share and Explore on Open Spaces
                </div>
                <div
                    class="grid grid-cols-1 bg-green-600 text-lg font-medium leading-normal text-white break-words sm:text-base">
                    <div class="py-8 px-4 sm:px-6 lg:px-8 border-b border-green-500">
                        <div class="max-w-xl">
                            Create spaces for storing and sharing resource collections, hold topic oriented discussions and build a community around your interests.
                            <div>
                                <a href="{{ route('space.create') }}">
                                    <x-jet-button overideBg="yes" class="mt-6 text-lg mr-5 bg-green-500 shadow-lg">
                                        Own Your Space
                                    </x-jet-button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="py-8 px-4 sm:px-6 lg:px-8">
                        <div class="max-w-xl">
                            Explore, join free spaces and discover resources based on your interest.
                            <div>
                                <a href="{{ route('space.index') }}">
                                    <x-jet-button overideBg="yes" class="mt-6 mb-6 text-lg bg-green-500 shadow-lg">
                                        Explore spaces
                                    </x-jet-button>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="h-2 mb-14 md:mb-0">
            <svg class="border-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#059669" fill-opacity="1"
                    d="M0,256L60,261.3C120,267,240,277,360,245.3C480,213,600,139,720,106.7C840,75,960,85,1080,112C1200,139,1320,181,1380,202.7L1440,224L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
                </path>
            </svg>
        </div>
    </div>

    <div class="max-w-6xl mx-auto">
        <div class="text-center pt-6 mb-5 md:mb-3 md:pt-0 md:mt-0 md:text-white text-green-600 text-2xl font-semibold">
            Explore Spaces
        </div>
        <div class="sm:px-6 pb-6 lg:px-8">
            <x-space.list :spaces="$spaces" />
        </div>
    </div>
</x-app-layout>