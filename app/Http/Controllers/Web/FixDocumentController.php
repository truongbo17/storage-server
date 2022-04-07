<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class FixDocumentController extends Controller
{
    public function truncate_all()
    {
        \DB::table('documents')->truncate();
        \DB::table('keywords')->truncate();
        \DB::table('document_keyword')->truncate();
    }

    public function fix(Request $request)
    {
        $sites = [
            'https://journals.plos.org',
            'https://www.scirp.org',
            'http://eprints.lse.ac.uk',
            'https://eprints.whiterose.ac.uk',
        ];

        if (in_array($request->referer, $sites)) {
            $documents = Document::where('referer', 'like', $request->referer . '%')
                ->limit(500)
                ->with('keywords');

            do {
                foreach ($documents->get() as $document) {
                    $document->keywords()->detach();
                }
                $deleted = $documents->delete();

                sleep(5);
            } while ($deleted > 0);

            return "Done delete all document and keyword ! Referer : $request->referer";
        }
        return 'No match referer !';
    }
}
