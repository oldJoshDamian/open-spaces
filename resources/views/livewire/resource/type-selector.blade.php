<div class="grid grid-cols-1 gap-6 sm:gap-6">
    <div>
        <x-jet-label value="Type" />
        <div class="flex items-start p-4 mt-3 border-t border-l border-r border-gray-300 bg-green-50 rounded-t-md">
            <x-jet-input value="document" wire:model="resource_type" name="resource_type" type="radio" />
            <div class="ml-2 -mt-1">
                <p class="font-semibold">
                    Document
                </p>
                <p class="text-sm text-gray-700">
                    Ebook, Word document, slide.
                </p>
            </div>
        </div>
        <div class="flex items-start p-4 border-t border-l border-r border-gray-300 bg-green-50">
            <x-jet-input value="personal_note" name="resource_type" wire:model="resource_type" type="radio" />
            <div class="ml-2 -mt-1">
                <p class="font-semibold">
                    Personal note
                </p>
                <p class="text-sm text-gray-700">
                    a personal note...
                </p>
            </div>
        </div>
        <div class="flex items-start p-4 border-t border-b border-l border-r border-gray-300 bg-green-50 rounded-b-md">
            <x-jet-input value="link" name="resource_type" wire:model="resource_type" type="radio" />
            <div class="ml-2 -mt-1">
                <p class="font-semibold">
                    Resource link
                </p>
                <p class="text-sm text-gray-700">
                    link to slide, ebook, youtube video e.t.c.
                </p>
            </div>
        </div>
        <x-jet-input-error class="mt-2" for="resource_type" />
    </div>
    <div>
        @switch($resource_type)
        @case('document')
        <x-jet-label value="Document Name (optional)" />
        <x-jet-input id="document_title" value="{{ old('document_title') }}" placeholder="name" class="block w-full mt-2"
            type="text" name="document_title" autocomplete="document_title" />
        <x-jet-label class="mt-6" value="File" />
        <input id="file" class="block w-full mt-2" type="file" name="document_file" required />
        <x-jet-input-error class="mt-2" for="document_file" />
        @break
        @case('link')
        <x-jet-label value="Resource link" />
        <x-jet-input id="link" value="{{ old('resource_link') }}" placeholder="resource link" class="block w-full mt-2"
            type="text" name="resource_link" required autocomplete="resource_link" />
        <x-jet-input-error class="mt-2" for="resource_link" />
        @break
        @case('personal_note')
        <x-jet-label value="Title (optional)" />
        <x-jet-input id="note_title" value="{{ old('note_title') }}" placeholder="title" class="block w-full mt-2"
            type="text" name="note_title" autocomplete="note_title" />
        <x-jet-input-error class="mt-2" for="note_title" />
        <x-jet-label class="mt-6" value="Content" />
        <textarea name="note_content" rows="5" autocomplete="note_content" placeholder="content" required class="block w-full mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
        <x-jet-input-error class="mt-2" for="note_content" />
        @break
        @endswitch
    </div>
    <div class="text-right ">
        <x-jet-button class="bg-green-500 ">add</x-jet-button>
    </div>
</div>