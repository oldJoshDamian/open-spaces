<x-app-layout>
    <div class="">
        <div class="bg-green-600">
            <div class="mx-auto tracking-wide text-white bg-green-600 max-w-7xl md:pt-14 md:pb-6 font-header">
                <div class="px-4 py-8 text-3xl font-extrabold leading-9 md:py-12 sm:px-6 lg:px-8 md:text-5xl">
                    Store, Share and Explore on Open Spaces
                </div>
                <div class="grid grid-cols-1 text-xl font-semibold text-white break-words bg-green-600 md:text-2xl sm:text-base">
                    <div class="px-4 py-8 border-b border-green-500 md:py-12 sm:px-0 sm:mx-6 lg:mx-8">
                        <div class="max-w-xl leading-10">
                            Create spaces for storing and sharing resource collections, hold topic oriented discussions and build a community around your interests.
                            <div>
                                <a href="{{ route('space.create') }}">
                                    <x-jet-button overideBg="yes" class="mt-6 mr-5 text-lg bg-green-500 shadow-lg">
                                        Own Your Space
                                    </x-jet-button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-8 sm:px-6 lg:px-8">
                        <div class="max-w-xl leading-10">
                            Explore, join public spaces and discover resources based on your interest.
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
        {{-- <div class="h-2 mx-auto max-w-7xl mb-14 md:mb-0">
            <svg class="border-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#059669" fill-opacity="1" d="M0,256L60,261.3C120,267,240,277,360,245.3C480,213,600,139,720,106.7C840,75,960,85,1080,112C1200,139,1320,181,1380,202.7L1440,224L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
                </path>
            </svg>
        </div> --}}
    </div>

    <div class="bg-green-50">
        <div class="mx-auto max-w-7xl py-14">
            <div class="text-3xl font-semibold text-center text-green-600 mb-9">
                Explore Spaces
            </div>
            <div class="sm:px-6 lg:px-8">
                <x-space.list :spaces="$spaces" />
            </div>
        </div>
    </div>

</x-app-layout>
