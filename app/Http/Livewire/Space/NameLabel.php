<?php

namespace App\Http\Livewire\Space;

use Livewire\Component;
use App\Models\Space;

class NameLabel extends Component
{
    public $spaceSlug;
    protected $listeners = [
        'saved' => '$refresh'
    ];

    public function getSpaceProperty() {
        return Space::firstWhere('slug', $this->spaceSlug);
    }

    public function render() {
        return view('livewire.space.name-label');
    }
}