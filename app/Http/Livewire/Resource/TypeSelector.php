<?php

namespace App\Http\Livewire\Resource;

use Livewire\Component;
use App\Models\File;
use App\Models\Resource;
use App\Models\User;

class TypeSelector extends Component
{
    public $resource_type;

    private function getUserFiles()
    {
        return  File::with(['resource'])->whereIn('id', Resource::where(function ($query) {
            $query->where('resourceful_type', File::class)->where('creator_id', auth()->user()->id);
        })->get()->pluck('id'))->latest()->get();
    }



    public function render()
    {
        return view('livewire.resource.type-selector', [
            'resource_type' => old('resource_type') ?? 'new_file',
            'userFiles' => $this->getUserFiles()
        ]);
    }
}
