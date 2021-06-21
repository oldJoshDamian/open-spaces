<?php

namespace App\Tools;

use App\Models\Document;
use App\Models\Topic;

class Crawler
{
    public function crawl()
    {
        switch (app('searc_engine')->data_set) {
            case ('all'):
                return $this->crawlForDocuments()->crawlForTopics();
                break;
        }
    }

    private function crawlForDocuments()
    {
        app('search_engine')->results->merge(Document::search(app('search_engine')->query)->with(['resource'])->get());
        return $this;
    }

    private function crawlForTopics()
    {
        app('search_engine')->results->merge(Topic::search(app('search_engine')->query)->with(['concept'])->get());
        return $this;
    }
}
