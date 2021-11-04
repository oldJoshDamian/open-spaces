<x-app-layout>
    @push('extras')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.9/plyr.css" />
    <script src="https://cdn.plyr.io/3.6.9/plyr.js"></script>
    @endpush
    <div class="">
        <audio id="player" controls>
            <source src="{{ $resource->resourceful->full_url }}" />
        </audio>
    </div>
    <script>
        const player = new Plyr('#player');

    </script>
</x-app-layout>
