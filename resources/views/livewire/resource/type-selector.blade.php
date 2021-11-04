<div class="grid grid-cols-1 gap-6 sm:gap-6">
    <div>
        <x-jet-label value="Type" />
        <div class="flex items-start p-4 mt-3 border-t border-l border-r border-gray-300 bg-blue-50 rounded-t-md">
            <x-jet-input value="new_file" wire:model="resource_type" name="resource_type" type="radio" />
            <div class="ml-2 -mt-1">
                <p class="font-semibold">
                    Upload New File
                </p>
                <p class="text-sm text-gray-700">
                    select a file from your device.
                </p>
            </div>
        </div>
        <div class="flex items-start p-4 border-t border-l border-r border-gray-300 bg-blue-50">
            <x-jet-input value="existing_file" name="resource_type" wire:model="resource_type" type="radio" />
            <div class="ml-2 -mt-1">
                <p class="font-semibold">
                    Choose From My Files.
                </p>
                <p class="text-sm text-gray-700">
                    select a file from your existing uploads.
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
        @case('new_file')
        <x-jet-label value="File Name" />
        <input id="poster_data" name="poster_data" hidden x-ref="poster_data" />
        <x-jet-input id="file_name" value="{{ old('file_name') }}" placeholder="name" class="block w-full mt-2" type="text" name="file_name" autocomplete="file_name" />
        <x-jet-input-error class="mt-2" for="file_name" />

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

        <div x-show="preview_ready" id="preview_parent" class="w-full my-4 overflow-x-auto max-h-64">
        </div>
        <x-jet-label class="mt-6" value="File" />
        <input id="file" x-on:change="previewFile()" class="block w-full mt-2" type="file" name="file" required />
        <x-jet-input-error class="mt-2" for="file" />
        @break

        @case('existing_file')
        <select class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="existing_file">
            <option>Select File</option>
            @foreach($userFiles as $file)
            <option @if($file->id === old('existing_file')) __('selected') @endif value="{{ $file->id }}">
                <span class="p-2 text-blue-700">#{{ last(explode("/", $file->mime_type)) }}</span>
                {{ $file->resource->title }}
            </option>
            @endforeach
        </select>
        <x-jet-input-error class="mt-2" for="existing_file" />

        <x-jet-label class="mt-6" value="Specific Pages (optional) - For Document files" />
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
        <div class="mt-6 text-right">
            <x-jet-button x-bind:disabled="!can_add">add</x-jet-button>
        </div>
    </div>
    <script>
        function data() {
            return {
                can_add: true
                , previewParent: false
                , preview_ready: false
                , previewFile: function() {
                    this.preview_ready = false;
                    this.can_add = false;
                    this.previewParent = document.getElementById('preview_parent');
                    this.previewParent.innerHTML = '';
                    let file = event.target.files[0];
                    let url = '';
                    if (!file) {
                        return;
                    }
                    document.getElementById('file_name').value = file.name;
                    url = URL.createObjectURL(file);
                    let fileType = file.type
                    console.log(fileType)
                    this.previewParent.innerHTML = "<div>Verify your upload:</div>";

                    if (fileType.includes('image')) {
                        this.previewImage(url);
                    }
                    if (fileType.includes('pdf')) {
                        this.previewPDF(url);
                    }
                    if (fileType.includes('video')) {
                        this.previewVideo(url);
                    }
                    if (fileType.includes('audio')) {
                        this.previewAudio(url)
                    }
                    this.preview_ready = true;
                    this.can_add = true;
                }
                , previewAudio: function(url) {
                    let audio = new Audio();
                    audio.src = url;
                    audio.setAttribute('controls', true)
                    this.previewParent.appendChild(audio);
                }
                , previewImage: function(url) {
                    let image = new Image();
                    image.src = url;
                    this.previewParent.appendChild(image);
                }
                , previewVideo: function(url) {
                    let video = document.createElement('video');
                    video.src = url;
                    video.setAttribute('controls', true);
                    video.addEventListener('loadedmetadata', function() {
                        let videoCanvas = document.createElement('CANVAS');
                        video.currentTime = 5;
                        let videoCtx = videoCanvas.getContext('2d');
                        videoCanvas.width = video.videoWidth;
                        videoCanvas.height = video.videoHeight;
                        videoCtx.drawImage(video, 0, 0, videoCanvas.width, videoCanvas.height);
                        document.getElementById('poster_data').value = videoCanvas.toDataURL();
                        console.log(document.getElementById('poster_data').value)
                        video.currentTime = 0;
                    });
                    this.previewParent.appendChild(video);
                }
                , previewPDF: function(url) {
                    let canvas = document.createElement('canvas');
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
                                    this.$refs.poster_data.value = canvas.toDataURL();
                                    this.previewParent.appendChild(canvas)
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
