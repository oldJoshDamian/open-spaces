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
                    only PDF documents are supported now!
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
    <div x-data="data()">
        @switch($resource_type)
        @case('document')
        <x-jet-label value="Document Name (optional)" />
        <input name="cover_page_data" hidden x-ref="cover_page_data" />
        <x-jet-input id="document_name" value="{{ old('document_name') }}" placeholder="name" class="block w-full mt-2"
            type="text" name="document_name" autocomplete="document_name" />
        <div x-show="preview_ready" class="my-4">
            Preview
            <canvas height="0" width="0" id="canvas"></canvas>
        </div>
        <x-jet-label class="mt-6" value="File" />
        <input id="file" x-on:change="previewPDF()" class="block w-full mt-2" accept=".pdf" type="file"
            name="document_file" required />
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
        <textarea name="note_content" rows="5" autocomplete="note_content" placeholder="content" required
            class="block w-full mt-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        <x-jet-input-error class="mt-2" for="note_content" />
        @break
        @endswitch
        <img x-ref="image">
        <div class="mt-6 text-right">
            <x-jet-button x-bind:disabled="!can_add" class="bg-green-500 ">add</x-jet-button>
        </div>
    </div>
    <script>
        function data() {
            return {
                can_add: true,
                preview_ready: false,
                previewPDF: function() {
                    this.can_add = false;
                    let file = event.target.files[0];
                    const canvas = document.getElementById('canvas');
                    let url = '';
                    if(file) {
                        url = URL.createObjectURL(file);
                    }
                    if(url) {
                        const loadingTask = pdfjsLib.getDocument(url);
                        loadingTask.promise.then((pdfDoc) => {
                            return pdfDoc.getPage(1).then((pdfPage) => {
                                const viewport = pdfPage.getViewport({ scale: 1.0 });
                                canvas.width = viewport.width;
                                canvas.height = viewport.height;
                                const ctx = canvas.getContext('2d');
                                const renderTask = pdfPage.render({
                                    canvasContext: ctx,
                                    viewport
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
