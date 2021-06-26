<?php

namespace App\Tools;

use Illuminate\Support\Collection;
use Laravel\Scout\Builder;

class SearchEngine
{
    private $query;
    private $data_sets = ['concepts', 'topics', 'resources', 'spaces'];
    private Collection $raw_results;
    private Collection $baked_results;
    private Crawler $crawler;

    public function __construct()
    {
        //
    }

    public function search(string $query = '', array $data_sets = ['concepts', 'topics', 'resources', 'spaces'])
    {
        $this->data_sets = $data_sets;
        $this->query = $query;
        if (!empty(trim($this->query))) {
            $this->crawler = resolve('SearchEngine\Crawler');
            $this->crawler->crawl();
        }
        return $this;
    }

    public function getRawResults(): Collection
    {
        return $this->raw_results ?? collect([]);
    }

    public function getBakedResults(): Collection
    {
        return $this->baked_results ?? collect([]);
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getDataSets()
    {
        return $this->data_sets;
    }

    public function bake(Collection $prepared_results)
    {
        return $this->baked_results = $prepared_results;
    }

    public function compileRawResults(string $key, Builder $result_set)
    {
        if (isset($this->raw_results)) {
        } else {
            $this->raw_results = collect([]);
        }
        return $this->raw_results = $this->raw_results->put($key, $result_set);
    }
}
