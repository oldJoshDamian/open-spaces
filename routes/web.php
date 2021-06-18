<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/spaces', 301);
//Route::get('/', ['App\Http\Controllers\HomeController', 'show'])->name('home');
Route::get('/spaces', ['App\Http\Controllers\SpaceController', 'index'])->name('space.index');
Route::get('/spaces/{space:slug}', ['App\Http\Controllers\SpaceController', 'show'])->name('space.show');
Route::get('/spaces/{space:slug}/concept/{concept:slug}', ['App\Http\Controllers\ConceptController', 'show'])->name('concept.show');
Route::get('/spaces/{space:slug}/concept/{concept:slug}/topic/{topic:slug}', ['App\Http\Controllers\TopicController', 'show'])->name('topic.show');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/user/spaces/create', ['App\Http\Controllers\SpaceController', 'create'])->name('space.create');
    Route::post('/user/spaces/store', ['App\Http\Controllers\SpaceController', 'store'])->name('space.store');

    Route::get('/user/spaces/{space:slug}/add-concept', ['App\Http\Controllers\ConceptController', 'create'])->name('concept.create');
    Route::post('/user/spaces/{space:slug}/store-concept', ['App\Http\Controllers\ConceptController', 'store'])->name('concept.store');

    Route::get('/user/spaces/{space:slug}/concept/{concept:slug}/add-topic', ['App\Http\Controllers\TopicController', 'create'])->name('topic.create');
    Route::post('/user/spaces/{space:slug}/concept/{concept:slug}/store-topic', ['App\Http\Controllers\TopicController', 'store'])->name('topic.store');

    Route::get('/user/spaces/{space:slug}/concept/{concept:slug}/topic/{topic:slug}/add-resource', ['App\Http\Controllers\ResourceController', 'createTopicResource'])->name('topic.resource.create');
    Route::post('/user/spaces/{space:slug}/concept/{concept:slug}/topic/{topic:slug}/store-resource', ['App\Http\Controllers\ResourceController', 'storeTopicResource'])->name('topic.resource.store');

    Route::get('/user/spaces/{space:slug}/concept/{concept:slug}/add-resource', ['App\Http\Controllers\ResourceController', 'createConceptResource'])->name('concept.resource.create');
    Route::post('/user/spaces/{space:slug}/concept/{concept:slug}/store-resource', ['App\Http\Controllers\ResourceController', 'storeConceptResource'])->name('concept.resource.store');
});

Route::redirect('/dashboard', '/spaces', 301);