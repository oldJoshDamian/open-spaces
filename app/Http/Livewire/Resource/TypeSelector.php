<?php

namespace App\Http\Livewire\Resource;

use Livewire\Component;

class TypeSelector extends Component
{
    public $resource_type = 'document';

    public function render()
    {
        return view('livewire.resource.type-selector');
    }
}
