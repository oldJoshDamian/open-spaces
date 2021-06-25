<?php

namespace App\Http\Livewire\Resource;

use Livewire\Component;
use App\Models\Document;
use App\Models\User;

class TypeSelector extends Component
{
    public $resource_type;

    private function getUserDocuments() {
        $user = User::with([
            'spaces.concepts.resources' => function ($query) {
                return $query->where('resourceful_type', Document::class);
            },
            'spaces.concepts.topics.resources' => function ($query) {
                return $query->where('resourceful_type', Document::class);
            },
            'ownedSpaces.concepts.resources' => function ($query) {
                return $query->where('resourceful_type', Document::class);
            },
            'ownedSpaces.concepts.topics.resources' => function ($query) {
                return $query->where('resourceful_type', Document::class);
            },
        ])->find(auth()->user()->id);

        $my_spaces = $user->spaces;
        $concepts1 = $my_spaces->pluck('concepts')->flatten();

        $concept_resources1 = $concepts1->pluck('resources')->flatten();
        $topics1 = $concepts1->pluck('topics')->flatten();
        $topic_resources1 = $topics1->pluck('resources')->flatten();
        $documents_1 = $concept_resources1->merge($topic_resources1)->where('resourceful_type', Document::class)->unique('title')->pluck('resourceful_id');

        $ownedSpaces = $user->ownedSpaces;
        $concepts2 = $ownedSpaces->pluck('concepts')->flatten();
        $concept_resources2 = $concepts2->pluck('resources')->flatten();
        $topics2 = $concepts2->pluck('topics')->flatten();
        $topic_resources2 = $topics2->pluck('resources')->flatten();
        $documents_2 = $concept_resources2->merge($topic_resources2)->where('resourceful_type', Document::class)->unique('title')->pluck('resourceful_id');
        return  Document::with(['resource'])->whereIn('id', $documents_1->merge($documents_2))->latest()->get();
    }



    public function render() {
        return view('livewire.resource.type-selector', [
            'resource_type' => old('resource_type') ?? 'new_document',
            'documents' => $this->getUserDocuments()
        ]);
    }
}