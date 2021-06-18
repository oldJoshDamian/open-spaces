<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Space;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TopicController extends Controller
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
    public function create(Space $space, Concept $concept)
    {
        return view('topic.create', compact('space', 'concept'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Space $space, Concept $concept)
    {
        $data = $request->validate([
            'topic_name' => ['required', 'string', Rule::unique('topics', 'name')->where('concept_id', $concept->id)]
        ], [
            'topic_name.unique' => 'You have created a topic with this name.'
        ]);
        $concept->topics()->create([
            'name' => $data['topic_name'],
            'slug' => Str::random(9)
        ]);
        return redirect()->route('concept.show', ['space' => $space, 'concept' => $concept])->with('flash.banner', 'Topic added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Space $space, Concept $concept, Topic $topic)
    {
        $resources = $topic->resources()->simplePaginate(12);
        return view('topic.show', compact('space', 'concept', 'topic', 'resources'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
