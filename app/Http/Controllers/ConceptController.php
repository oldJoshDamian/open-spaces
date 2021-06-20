<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Space;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ConceptController extends Controller
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
    public function create(Space $space) {
        return view('concept.create', compact('space'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request, Space $space) {
        $data = $request->validate([
            'concept_title' => ['required', 'string', 'min:3', Rule::unique('concepts', 'title')->where('space_id', $space->id)]
        ], [
            'concept_title.unique' => 'You have created a concept with this title.'
        ]);
        $space->concepts()->create([
            'title' => $data['concept_title'],
            'slug' => Str::random(7)
        ]);
        return redirect()->route('space.show', ['space' => $space])->with('flash.banner', 'Concept added successfully!');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Concept  $concept
    * @return \Illuminate\Http\Response
    */
    public function show(Space $space, Concept $concept) {
        $topics = $concept->topics()->simplePaginate(12);
        $resources = Resource::with(['resourceful'])->whereIn('resourceable_id', $topics->pluck('id')->merge($concept->id))->latest()->simplePaginate(12);
        return view('concept.show', compact('space', 'concept', 'topics', 'resources'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Concept  $concept
    * @return \Illuminate\Http\Response
    */
    public function edit(Concept $concept) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Concept  $concept
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Concept $concept) {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Concept  $concept
    * @return \Illuminate\Http\Response
    */
    public function destroy(Concept $concept) {
        //
    }
}