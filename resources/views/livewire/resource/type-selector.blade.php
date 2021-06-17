<div class="grid grid-cols-1 gap-4 sm:gap-6">
    <div>
        <x-jet-label value="Type" />
        <div class="flex items-start p-4 mt-3 border-t border-l border-r border-gray-300 bg-green-50 rounded-t-md">
            <x-jet-input value="document" wire:model="resource_type" name="resource_type" type="radio" />
            <div class="ml-2 -mt-1">
                <p class="font-semibold">Document</p>
                <p class="text-sm text-gray-700">
                    Ebook, Word document, slide.
                </p>
            </div>
        </div>
        <div class="flex items-start p-4 border-t border-b border-l border-r border-gray-300 bg-green-50 rounded-b-md">
            <x-jet-input value="link" name="resource_type" wire:model="resource_type" type="radio" />
            <div class="ml-2 -mt-1">
                <p class="font-semibold">Resource link</p>
                <p class="text-sm text-gray-700">
                    link to slide, ebook, youtube video e.t.c.
                </p>
            </div>
        </div>
        <x-jet-input-error class="mt-2" for="resource_type" />
    </div>
    <div>
        @if($resource_type === 'document')
        <x-jet-label value="File" />
        <input id="file" class="block w-full mt-2" type="file" name="resource_file" required />
        <x-jet-input-error class="mt-2" for="resource_file" />
        @elseif($resource_type === 'link')
        <x-jet-input id="link" value="{{ old('resource_link') }}" placeholder="resource link" class="block w-full mt-2"
            type="text" name="resource_link" required autocomplete="resource_link" />
        @endif
    </div>
    <div class="text-right ">
        <x-jet-button class="bg-green-500 ">add</x-jet-button>
    </div>
</div>
