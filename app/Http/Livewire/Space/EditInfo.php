<?php

namespace App\Http\Livewire\Space;

use Livewire\Component;
use App\Models\Space;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class EditInfo extends Component
{
    use WithFileUploads;

    public $spaceSlug;
    public $state;
    public $photo;

    public function rules () {
        return [
            'state.name' => [
                'required',
                'string',
                'min:3',
                Rule::unique('spaces', 'name')->where('creator_id', $this->user->id)->ignore($this->space->id)
            ],
            'state.visibility' => [Rule::in(['public', 'private'])],
            'state.description' => [
                'string',
                'nullable',
                'min:3'
            ]
        ];
    }

    public function saveInfo() {
        $this->validate(null, [
            'state.name.unique' => 'You have created a space with this name'
        ]);
        if ($this->photo) {
            $this->space->updateProfilePhoto($this->photo);
        }
        $this->state->save();
        $this->emitTo('space.name-label', 'saved');
        $this->emitSelf('saved');
    }

    public function deleteProfilePhoto() {
        return $this->state->deleteProfilePhoto();
    }

    public function mount() {
        $this->state = $this->space;
    }

    public function getSpaceProperty() {
        return Space::firstWhere('slug', $this->spaceSlug);
    }

    public function getUserProperty() {
        return auth()->user();
    }

    public function render() {
        return view('livewire.space.edit-info');
    }
}