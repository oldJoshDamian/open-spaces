<div class="grid grid-cols-1 gap-6 sm:gap-6">
    <div>
        <x-jet-label value="Type" />
        <div class="flex items-start p-4 mt-3 border-t border-l border-r border-gray-300 bg-blue-50 rounded-t-md">
            <x-jet-input value="new_document" wire:model="resource_type" name="resource_type" type="radio" />
            <div class="ml-2 -mt-1">
                <p class="font-semibold">
                    Upload New Document
                </p>
            </div>
        </div>
        <div class="flex items-start p-4 border-t border-l border-r border-gray-300 bg-blue-50">
            <x-jet-input value="existing_document" name="resource_type" wire:model="resource_type" type="radio" />
            <div class="ml-2 -mt-1">
                <p class="font-semibold">
                    Choose From My Document.
                </p>
                <p class="text-sm text-gray-700">
                    choose a document from your existing documents.
                </p>
            </div>
        </div>
        <div class="flex items-start p-4 border-t border-l border-r border-gray-300 bg-blue-50">
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
        <div class="flex items-start p-4 border-t border-b border-l border-r border-gray-300 bg-blue-50 rounded-b-md">
            <x-jet-input value="resource_link" name="resource_type" wire:model="resource_type" type="radio" />
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
    <div x-data="data()">
        @switch($resource_type)
        @case('new_document')
        <x-jet-label value="Document Name (optional)" />
        <input name="cover_page_data" hidden x-ref="cover_page_data" />
        <x-jet-input id="document_name" value="{{ old('document_name') }}" placeholder="name" class="block w-full mt-2" type="text" name="document_name" autocomplete="document_name" />
        <x-jet-input-error class="mt-2" for="document_name" />

        <x-jet-label class="mt-6" value="Specific Pages (optional)" />
        <div class="grid grid-cols-2 gap-4 pt-3">
            <div>
                <x-jet-input id="document_start_page" value="{{ old('document_start_page') }}" placeholder="from" class="block w-full" type="number" name="document_start_page" autocomplete="document_start_page" />
                <x-jet-input-error class="mt-2" for="document_start_page" />
            </div>
            <div>
                <x-jet-input id="document_end_page" value="{{ old('document_end_page') }}" placeholder="to" class="block w-full" type="number" name="document_end_page" autocomplete="document_end_page" />
                <x-jet-input-error class="mt-2" for="document_end_page" />
            </div>
        </div>

        <div x-show="preview_ready" class="w-full my-4 overflow-x-auto max-h-96">
            Preview
            <canvas id="canvas"></canvas>
        </div>
        <x-jet-label class="mt-6" value="File" />
        <input id="file" x-on:change="previewDocument()" class="block w-full mt-2" accept=".pdf" type="file" name="document_file" required />
        <x-jet-input-error class="mt-2" for="document_file" />
        @break

        @case('existing_document')
        <select class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="existing_document">
            <option>Select Document</option>
            @foreach($documents as $document)
            <option @if($document->id === old('existing_document')) __('selected') @endif value="{{ $document->id }}">
                {{ $document->resource->title }}
            </option>
            @endforeach
        </select>
        <x-jet-input-error class="mt-2" for="existing_document" />

        <x-jet-label class="mt-6" value="Specific Pages (optional)" />
        <div class="grid grid-cols-2 gap-4 pt-3">
            <div>
                <x-jet-input id="document_start_page" value="{{ old('document_start_page') }}" placeholder="from" class="block w-full" type="number" name="document_start_page" autocomplete="document_start_page" />
                <x-jet-input-error class="mt-2" for="document_start_page" />
            </div>
            <div>
                <x-jet-input id="document_end_page" value="{{ old('document_end_page') }}" placeholder="to" class="block w-full" type="number" name="document_end_page" autocomplete="document_end_page" />
                <x-jet-input-error class="mt-2" for="document_end_page" />
            </div>
        </div>
        @break

        @case('resource_link')
        <x-jet-label value="Link Title (optional)" />
        <x-jet-input id="link_title" value="{{ old('link_title') }}" placeholder="title" class="block w-full mt-2" type="text" name="link_title" autocomplete="link_title" />
        <x-jet-label class="mt-6" value="Resource link" />
        <x-jet-input id="link" value="{{ old('resource_link') }}" placeholder="resource link" class="block w-full mt-2" type="text" name="resource_link" required autocomplete="resource_link" />
        <x-jet-input-error class="mt-2" for="resource_link" />
        @break
        @case('personal_note')
        <x-jet-label value="Title (optional)" />
        <x-jet-input id="note_title" value="{{ old('note_title') }}" placeholder="title" class="block w-full mt-2" type="text" name="note_title" autocomplete="note_title" />
        <x-jet-input-error class="mt-2" for="note_title" />
        <x-jet-label class="mt-6" value="Content" />
        <textarea name="note_content" rows="5" autocomplete="note_content" placeholder="content" required class="block w-full mt-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('note_content') }}</textarea>
        <x-jet-input-error class="mt-2" for="note_content" />
        @break
        @endswitch
        <img x-ref="image">
        <div class="mt-6 text-right">
            <x-jet-button x-bind:disabled="!can_add">add</x-jet-button>
        </div>
    </div>
    <script>
        function data() {
            return {
                can_add: true
                , preview_ready: false
                , previewPDF: function() {
                    this.can_add = false;
                    let file = event.target.files[0];
                    document.getElementById('document_name').value = file.name;
                    const canvas = document.getElementById('canvas');
                    let url = '';
                    if (file) {
                        url = URL.createObjectURL(file);
                    }
                    if (url) {
                        const loadingTask = pdfjsLib.getDocument(url);
                        loadingTask.promise.then((pdfDoc) => {
                            return pdfDoc.getPage(1).then((pdfPage) => {
                                const viewport = pdfPage.getViewport({
                                    scale: 1.0
                                });
                                canvas.width = viewport.width;
                                canvas.height = viewport.height;
                                const ctx = canvas.getContext('2d');
                                const renderTask = pdfPage.render({
                                    canvasContext: ctx
                                    , viewport
                                });
                                return renderTask.promise.then((result) => {
                                    URL.revokeObjectURL(url);
                                    this.$refs.cover_page_data.value = canvas.toDataURL();
                                    this.preview_ready = true;
                                    this.can_add = true;
                                });
                            });
                        }).catch((error) => {
                            console.error('Error: ' + error);
                        });
                    }
                }
            }
        }

    </script>
</div>
