<?php

namespace App\Tools;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class SearchEngine
{
    private $query;
    private $data_set = 'all';
    private Collection $results;
    private Crawler $crawler;

    public function __construct()
    {
        //
    }

    public function search(string $query = '', string $data_set = 'all')
    {
        $this->data_set = $data_set;
        $this->query = $query;
        if (!empty(trim($this->query))) {
            $this->crawler = resolve('SearchEngine\Crawler');
            $this->crawler->crawl();
        }
        return $this;
    }

    public function getResults()
    {
        return $this->results ?? collect([]);
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getDataSet()
    {
        return $this->data_set;
    }

    public function compileResults(string $key, Collection|EloquentCollection $result_set)
    {
        if (isset($this->results)) {
        } else {
            $this->results = collect([]);
        }
        return $this->results = $this->results->put($key, $result_set);
    }
}
