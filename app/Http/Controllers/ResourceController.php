<?php

namespace App\Http\Controllers;

use App\Actions\OpenSpaces\File\UploadNewFile;
use App\Actions\OpenSpaces\File\UploadPoster;
use App\Models\Concept;
use App\Models\Resource;
use App\Models\Topic;
use Illuminate\Support\Str;
use App\Models\Space;
use Illuminate\Http\Request;
use App\Models\ResourceLink;
use Illuminate\Validation\Rule;
use App\Models\File;
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
    public function storeTopicResource(Request $request, Space $space, Concept $concept, Topic $topic)
    {
        $resource = $this->createResource($request, $topic);
        return redirect()->route('topic.show', [
            'space' => $space,
            'concept' => $concept,
            'topic' => $topic
        ])->with('flash.banner', 'Resource added successfully!');
    }

    private function resourceStorageDisk()
    {
        return config('filesystems.resource_disk');
    }

    public function createConceptResource(Space $space, Concept $concept)
    {
        return view('resource.create', compact('space', 'concept'));
    }

    private function createResourceRules()
    {
        return [
            'resource_type' => [
                'required', Rule::in(['new_file', 'resource_link', 'personal_note', 'existing_file'])
            ],
            'file' => [
                'required_if:resource_type,new_file', 'file', 'sometimes'
            ],
            'existing_file' => [
                'required_if:resource_type,exisiting_file', 'sometimes', 'exists:files,id'
            ],
            'file_name' => [
                'string', 'nullable', 'min:3'
            ],
            'document_start_page' => [
                'int', 'nullable', 'required_with:document_end_page'
            ],
            'document_end_page' => [
                'int', 'nullable', 'gt:document_start_page'
            ],
            'note_title' => [
                'string', 'nullable', 'min:3'
            ],
            'note_content' => [
                'string', 'required', 'min:10', 'sometimes'
            ],
            'resource_link' => ['url', 'string', 'sometimes', 'required_if:resource_type,resource_link'],
            'link_title' => ['string', 'nullable', 'min:3']
        ];
    }

    private function createResource(Request $request, $resourceable)
    {
        $data = $request->validate($this->createResourceRules());
        $resource = $resourceable->resources()->create([
            'slug' => Str::random(8),
            'creator_id' => $request->user()->id
        ]);

        switch ($data['resource_type']):
            case ('new_file'):
                $file = $request->file('file');
                $poster_path = null;
                $uploadedFile = UploadNewFile::upload($file);
                $resource->title = $data['file_name'] ?? $uploadedFile['fileName'];
                if (($uploadedFile['mimeType'] === 'application/pdf' || $uploadedFile['mimeType'] === 'video/mp4') && $request->poster_data) {
                    $poster_path = UploadPoster::upload($request->poster_data);
                }
                File::create([
                    'hash' => $uploadedFile['filePath'],
                    'mime_type' => $uploadedFile['mimeType'],
                    'poster' => $poster_path,
                    'specific_pages' => ($data['document_start_page']) ? ['start_page' => $data['document_start_page'], 'end_page' => $data['document_end_page']] : null,
                    'stored_on' => config('filesystems.resource_disk')
                ])->resource()->save($resource);
                break;
            case ('existing_file'):
                $file = File::find($data['existing_file']);
                $resource->title = $file->resource->title;
                File::create([
                    'url' => $file->url,
                    'mime_type' => $file->mime_type,
                    'poster' => $file->poster,
                    'specific_pages' => ($data['document_start_page']) ? ['start_page' => $data['document_start_page'], 'end_page' => $data['document_end_page']] : null,
                    'stored_on' => $file->stored_on
                ])->resource()->save($resource);
                break;
            case ('personal_note'):
                $resource->title = $data['note_title'] ?? 'Untitled Note';
                PersonalNote::create([
                    'content' => $data['note_content']
                ])->resource()->save($resource);
                break;
            case ('resource_link'):
                $resource->title = $data['link_title'] ?? 'Untitled Link';
                ResourceLink::create([
                    'url' => $data['resource_link']
                ])->resource()->save($resource);
                break;
        endswitch;
        $resource->push();
        return $resource;
    }

    public function storeConceptResource(Request $request, Space $space, Concept $concept)
    {
        $this->createResource($request, $concept);
        return redirect()->route('concept.show', ['space' => $space, 'concept' => $concept])->with('flash.banner', 'Resource added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(string $type, Resource $resource)
    {
        switch ($type):
            case ($type === 'document'):
                return view('resource.show-pdf', compact('resource'));
                break;
            case ($type === 'personal-note'):
                return view('resource.show-personal-note', compact('resource'));
                break;
            default:
                return redirect()->route('home');
                break;
        endswitch;
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
