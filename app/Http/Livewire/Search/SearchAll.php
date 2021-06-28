<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;

class SearchAll extends Component
{
    public $query;
    public $only = 'all';
    public $shouldSuggest = true;
    public $showResults = false;

    public function stopSuggestion()
    {
        $this->search();
        $this->showResults = true;
        $this->shouldSuggest = false;
        return;
    }

    public function setQuery($queryString)
    {
        $this->query = $queryString;
        $this->stopSuggestion();
        return true;
    }

    public function getResultsProperty()
    {
        return $this->search_engine->getBakedResults();
    }

    public function search()
    {
        $this->shouldSuggest = true;
        $this->showResults = false;
        $this->search_engine->search($this->query)->bake($this->search_engine->getRawResults()->mapWithKeys(function ($result_build, $key) {
            return [$key => $result_build->get()];
        }));
    }

    public function updatedQuery()
    {
        $this->search();
    }

    public function getSearchEngineProperty()
    {
        return resolve('SearchEngine');
    }

    public function render()
    {
        return view('livewire.search.search-all', [
            'results' => ($this->only === 'all') ? $this->results->flatten() : $this->results[$this->only]
        ]);
    }
}
