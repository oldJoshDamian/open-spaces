<?php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->check()) {
            $spaces = Space::whereIn('id', $request->user()->allSpaces()->pluck('id'))->latest('updated_at')->simplePaginate(8);
        } else {
            $spaces = Space::where('creator_id', null)->simplePaginate(12);
        }
        $discover = Space::where('visibility', 'public')->whereNotIn('id', $spaces->pluck('id'))->latest('updated_at')->simplePaginate(8);
        return view('space.index', compact('spaces', 'discover'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('space.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'space_name' => ['required', 'string', 'min:3', Rule::unique('spaces', 'name')->where('creator_id', $user->id)],
            'visibility' => [Rule::in(['public', 'private'])]
        ], [
            'space_name.unique' => 'You have created a space with this name'
        ]);
        $space = $user->ownedSpaces()->create([
            'name' => $data['space_name'],
            'visibility' => $data['visibility'],
            'slug' => Str::random(12)
        ]);
        $space->members()->attach($user->id, [
            'role_hash' => Hash::make('owner_' . $user->id)
        ]);
        return redirect()->route('space.index')->with('flash.banner', 'Space created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function show(Space $space)
    {
        if ($space->visibility === 'private' && !auth()->user()) {
            return redirect()->route('space.index');
        }
        $this->authorize('view', $space);
        $concepts = $space->concepts()->simplePaginate(12);
        return view('space.show', compact('space', 'concepts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function edit(Space $space)
    {
        $this->authorize('update', $space);
        return view('space.edit', compact('space'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Space $space)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function destroy(Space $space)
    {
        //
    }
}
