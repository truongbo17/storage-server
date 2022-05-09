<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use ElasticScoutDriverPlus\Support\Query;
use Illuminate\Http\Request;

class SearchCrudController extends Controller
{
    protected function search()
    {
        return view('admin.search');
    }

    public function searchData(Request $request)
    {
        if ($request->q) {
            $q = $request->q;
            $query = Query::matchPhrasePrefix()
                ->field('title')
                ->query($request->q);

            $searchResult = Document::searchQuery($query)->execute();
            $data = $searchResult->hits();

//            $highlights = $searchResult->highlights();
//            $highlight = $highlights->first();
//            $snippets = $highlight->snippets('title');
//            dd($snippets);
//            $hit = $data->first();

//            $indexName = $hit->indexName();
//            $score = $hit->score();
//            $model = $hit->model();
//            $document = $hit->document();
//            $highlight = $hit->highlight();
//            $innerHits = $hit->innerHits();


            return view('admin.search', compact('data', 'q'));
        }
    }
}
