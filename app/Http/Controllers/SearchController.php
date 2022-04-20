<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use ElasticScoutDriverPlus\Support\Query;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->q) {

            $query = Query::matchAll();

            $searchResult = Document::searchQuery($query)->execute();

            dd($searchResult);
        }
        return 'Please fill keyword';
    }
}
