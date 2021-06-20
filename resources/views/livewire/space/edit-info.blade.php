<x-jet-form-section submit="saveInfo">
    <x-slot name="title">
        {{ __('Space information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your space\'s information') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->
            <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
            photoName = $refs.photo.files[0].name;
            const reader = new FileReader();
            reader.onload = (e) => {
            photoPreview = e.target.result;
            };
            reader.readAsDataURL($refs.photo.files[0]);
            " />

            <x-jet-label for="photo" value="{{ __('Cover Photo') }}" />

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ $this->space->profile_photo_url }}" alt="{{ $this->space->name }}"
                    class="object-cover h-48 w-72">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview">
                <span class="block h-48 w-72"
                    x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </x-jet-secondary-button>

            @if ($this->space->profile_photo_path)
            <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                {{ __('Remove Photo') }}
            </x-jet-secondary-button>
            @endif

            <x-jet-input-error for="photo" class="mt-2" />
        </div>


        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="block w-full mt-1" wire:model.defer="state.name"
                autocomplete="name" />
            <x-jet-input-error for="state.name" class="mt-2" />
        </div>

        <!-- Visibility -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="visibility" value="{{ __('Visibility') }}" />
            <div class="flex items-start p-4 mt-3 border-t border-l border-r border-gray-300 bg-green-50 rounded-t-md">
                <x-jet-input value="public" wire:model.defer="state.visibility" name="visibility" type="radio" />
                <div class="ml-2 -mt-1">
                    <p class="font-semibold">
                        Public
                    </p>
                    <p class="text-sm text-gray-700">
                        Anyone can find, access and join this space.
                    </p>
                </div>
            </div>
            <div
                class="flex items-start p-4 border-t border-b border-l border-r border-gray-300 bg-green-50 rounded-b-md">
                <x-jet-input value="private" wire:model.defer="state.visibility" name="visibility" type="radio" />
                <div class="ml-2 -mt-1">
                    <p class="font-semibold">
                        Private
                    </p>
                    <p class="text-sm text-gray-700">
                        only you can find and access this space.
                    </p>
                </div>
            </div>
            <x-jet-input-error for="state.visibility" class="mt-2" />
        </div>

        <!-- Description -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="description" value="{{ __('Description') }}" />
            <textarea id="description" name="space_description" rows="5" autocomplete="space_description"
                wire:model.defer="state.description" placeholder="description"
                class="block w-full mt-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            <x-jet-input-error for="state.description" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-action-message on="saved">
                <x-jet-banner message="Saved!" />
            </x-jet-action-message>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-button class="bg-green-500" wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
