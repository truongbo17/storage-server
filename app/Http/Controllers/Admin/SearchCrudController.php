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
            $query = Query::multiMatch()
                ->fields(['title', 'content'])
                ->query($request->q);

            $searchResult = Document::searchQuery($query)
                ->highlightRaw([
                    "pre_tags" => ["<b>"],
                    "post_tags" => ["</b>"],
                    'fields' =>
                        [
                            'title' => ['number_of_fragments' => 0],
                            'content' => ['number_of_fragments' => 0],
                        ]
                ])
                ->execute();
            $data = $searchResult->hits();

            $highlights = $searchResult->highlights();


            return view('admin.search', compact('data', 'highlights', 'q'));
        }
    }
}
