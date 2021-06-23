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
        $crawler = "crawlFor" . Str::title($this->getDataSet());
        if (method_exists($this, $crawler)) {
            return $this->{$crawler}();
        } else {
            return $this->crawlForConcepts()->crawlForResources()->crawlForSpaces()->crawlForTopics();
        }
    }

    public function getDataSet(): string
    {
        return $this->searchEngine()->getDataSet();
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
        $this->searchEngine()->compileResults('resources', Resource::search($this->getQuery())->get());
        return $this;
    }

    public function crawlForTopics()
    {
        $this->searchEngine()->compileResults('topics', Topic::search($this->getQuery())->get());
        return $this;
    }

    public function crawlForConcepts()
    {
        $this->searchEngine()->compileResults('concepts', Concept::search($this->getQuery())->get());
        return $this;
    }

    public function crawlForSpaces()
    {
        $this->searchEngine()->compileResults('spaces', Space::search($this->getQuery())->get());
        return $this;
    }
}
