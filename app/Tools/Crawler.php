<?php

namespace App\Tools;

use App\Models\Concept;
use App\Models\Resource;
use App\Models\Space;
use App\Models\Topic;
use Illuminate\Support\Str;

class Crawler
{
    public function crawl()
    {
        $data_sets = $this->getDataSets();
        collect($data_sets)->each(function ($data_set) {
            $crawler = "crawlFor" . Str::title($data_set);
            if (method_exists($this, $crawler)) {
                return $this->{$crawler}();
            }
        });
    }

    public function getDataSets(): array
    {
        return $this->searchEngine()->getDataSets();
    }

    public function getQuery(): string
    {
        return $this->searchEngine()->getQuery();
    }

    public function searchEngine()
    {
        return resolve('SearchEngine');
    }

    public function crawlForResources()
    {
        $this->searchEngine()->compileRawResults('resources', Resource::search($this->getQuery()));
        return $this;
    }

    public function crawlForTopics()
    {
        $this->searchEngine()->compileRawResults('topics', Topic::search($this->getQuery()));
        return $this;
    }

    public function crawlForConcepts()
    {
        $this->searchEngine()->compileRawResults('concepts', Concept::search($this->getQuery()));
        return $this;
    }

    public function crawlForSpaces()
    {
        $this->searchEngine()->compileRawResults('spaces', Space::search($this->getQuery()));
        return $this;
    }
}
