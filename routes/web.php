<?php

use App\Http\Controllers\ResourceController;
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

//Route::redirect('/', '/spaces', 301);
Route::get('/', ['App\Http\Controllers\HomeController', 'index'])->name('home');
Route::get('/spaces', ['App\Http\Controllers\SpaceController', 'index'])->name('space.index');
Route::get('/spaces/{space}', ['App\Http\Controllers\SpaceController', 'show'])->name('space.show');
Route::get('/spaces/{space}/concept/{concept}', ['App\Http\Controllers\ConceptController', 'show'])->name('concept.show');
Route::get('/spaces/{space}/concept/{concept}/topic/{topic}', ['App\Http\Controllers\TopicController', 'show'])->name('topic.show');

Route::get('/resource-viewer/{type}/{resource}', [ResourceController::class, 'show'])->name('resource.view');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/user/spaces/create', ['App\Http\Controllers\SpaceController', 'create'])->name('space.create');
    Route::post('/user/spaces/store', ['App\Http\Controllers\SpaceController', 'store'])->name('space.store');

    Route::get('/user/spaces/{space}/edit', ['App\Http\Controllers\SpaceController', 'edit'])->name('space.edit');

    Route::get('/user/spaces/{space}/add-concept', ['App\Http\Controllers\ConceptController', 'create'])->name('concept.create');
    Route::post('/user/spaces/{space}/store-concept', ['App\Http\Controllers\ConceptController', 'store'])->name('concept.store');

    Route::get('/user/spaces/{space}/concept/{concept}/add-topic', ['App\Http\Controllers\TopicController', 'create'])->name('topic.create');
    Route::post('/user/spaces/{space}/concept/{concept}/store-topic', ['App\Http\Controllers\TopicController', 'store'])->name('topic.store');

    Route::get('/user/spaces/{space}/concept/{concept}/topic/{topic}/add-resource', ['App\Http\Controllers\ResourceController', 'createTopicResource'])->name('topic.resource.create');
    Route::post('/user/spaces/{space}/concept/{concept}/topic/{topic}/store-resource', ['App\Http\Controllers\ResourceController', 'storeTopicResource'])->name('topic.resource.store');

    Route::get('/user/spaces/{space}/concept/{concept}/add-resource', ['App\Http\Controllers\ResourceController', 'createConceptResource'])->name('concept.resource.create');
    Route::post('/user/spaces/{space}/concept/{concept}/store-resource', ['App\Http\Controllers\ResourceController', 'storeConceptResource'])->name('concept.resource.store');
});

Route::redirect('/dashboard', '/spaces');
