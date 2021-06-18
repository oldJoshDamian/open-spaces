<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Resource;
use App\Models\Topic;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Document;
use App\Models\PersonalNote;

class ResourceController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {
        //
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function createTopicResource(Space $space, Concept $concept, Topic $topic) {
        return view('resource.create', compact('space', 'concept', 'topic'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function storeTopicResource(Request $request) {
        //
    }

    public function createConceptResource(Space $space, Concept $concept) {
        return view('resource.create', compact('space', 'concept'));
    }

    public function storeConceptResource(Request $request) {
        $data = $request->validate([
            'resource_type' => ['required', Rule::in(['document', 'resource_link', 'personal_note'])],
            'document_file' => ['required', 'file', 'sometimes'],
            'document_name' => ['string', 'nullable', 'min:3'],
            'note_title' => ['string', 'nullable', 'min:3'],
            'note_content' => ['string', 'required', 'min:10', 'sometimes']
        ]);

        $document_file = $request->file('document_file');
        $mime_type = $document_file->getMimeType();
        $filename = $data['document_name'] ?? $document_file->getClientOriginalName();

        switch ($data['resource_type']):
        case('document'):
            $resource = Document::create([
                'url' => $document_file->store('resource_files', 'public'),
                'title' => $filename,
                'mime_type' => $mime_type,
            ]);
            break;
        case('personal_note'):
            $resource = PersonalNote::create([
                'title' => $data['note_title'],
                'content' => $data['note_content']
            ]);
            break;
        case('resource_link'):
            $resource = Link::create([
                'title' => $data['link_title'],
                'url' => $data['link_url']
            ]);
            break;
        endswitch;
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Resource  $resource
    * @return \Illuminate\Http\Response
    */
    public function show(Resource $resource) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Resource  $resource
    * @return \Illuminate\Http\Response
    */
    public function edit(Resource $resource) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Resource  $resource
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Resource $resource) {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Resource  $resource
    * @return \Illuminate\Http\Response
    */
    public function destroy(Resource $resource) {
        //
    }
}