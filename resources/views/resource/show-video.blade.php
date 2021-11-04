<x-app-layout>
    @push('extras')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.9/plyr.css" />
    <script src="https://cdn.plyr.io/3.6.9/plyr.js"></script>
    @endpush
    <div class="">
        <video id="player" playsinline controls data-poster="{{ $resource->resourceful->poster_url }}">
            <source src="{{ $resource->resourceful->full_url }}" type="video/mp4" />
        </video>
    </div>
    <script>
        const player = new Plyr('#player');

    </script>
</x-app-layout>
