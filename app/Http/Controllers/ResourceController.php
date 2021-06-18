<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Resource;
use App\Models\Topic;
use Illuminate\Support\Str;
use App\Models\Space;
use Illuminate\Http\Request;
use App\Models\ResourceLink;
use Illuminate\Support\Facades\Storage;
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTopicResource(Space $space, Concept $concept, Topic $topic)
    {
        return view('resource.create', compact('space', 'concept', 'topic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTopicResource(Request $request)
    {
        //
    }

    public function createConceptResource(Space $space, Concept $concept)
    {
        return view('resource.create', compact('space', 'concept'));
    }

    public function storeConceptResource(Request $request, Space $space, Concept $concept)
    {
        $data = $request->validate([
            'resource_type' => ['required', Rule::in(['document', 'resource_link', 'personal_note'])],
            'document_file' => ['required', 'file', 'sometimes', 'mimetypes:application/pdf,application'],
            'document_name' => ['string', 'nullable', 'min:3'],
            'note_title' => ['string', 'nullable', 'min:3'],
            'note_content' => ['string', 'required', 'min:10', 'sometimes']
        ]);

        switch ($data['resource_type']):
            case ('document'):
                $document_file = $request->file('document_file');
                $mime_type = $document_file->getMimeType();
                $filepath = $document_file->store('resource_files', 'public');
                $cover_page_data = substr($request->cover_page_data, strpos($request->cover_page_data, ",") + 1);
                if ($cover_page_data) {
                    $cover_page_name = Str::random(16) . '.png';
                    $cover_page_path = 'document_cover_pages/' . $cover_page_name;
                    Storage::disk('public')->put($cover_page_path, base64_decode($cover_page_data));
                }
                $filename = $data['document_name'] ?? $document_file->getClientOriginalName();
                $resource = Document::create([
                    'url' => $filepath,
                    'title' => $filename,
                    'mime_type' => $mime_type,
                    'cover_page' => $cover_page_path
                ]);
                break;
            case ('personal_note'):
                $resource = PersonalNote::create([
                    'title' => $data['note_title'],
                    'content' => $data['note_content']
                ]);
                break;
            case ('resource_link'):
                $resource = ResourceLink::create([
                    'title' => $data['link_title'],
                    'url' => $data['link_url']
                ]);
                break;
        endswitch;
        $concept->resources()->create([
            'resourceful_type' => $resource::class,
            'resourceful_id' => $resource->id,
            'slug' => Str::random(8)
        ]);
        return redirect()->route('concept.show', ['space' => $space, 'concept' => $concept])->with('flash.banner', 'Resource added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        //
    }
}
