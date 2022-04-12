<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Services\DocumentManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;

class DocumentController extends Controller
{
    public function store(Request $request)
    {
        /**
         * If the main content is empty, sub content will be used instead
         */
        if (preg_match("/^https:\/\/www\.scirp\.org/", $request->referer_links) && !is_null($request->abstract)) {
            //fix site https://www.scrip.org
            $request->description = $request->abstract; //Main content
        }
        if (is_null($request->description) && !is_null($request->abstract)) {
            $request->merge([
                'description' => $request->abstract,
                'abstract' => null,
            ]);
        }

        $validator = Validator::make($request->all(), [
            'title' => "required|string",
            'description' => "required|string",
            'abstract' => "nullable|string",
            'download_link' => "required|string",
            'referer_links' => "required|string",
            "author" => "nullable|array",
            'keywords' => "nullable|array",
        ]);

        if ($validator->fails()) {
            Log::error($validator->errors());
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $title = $request->title;
        $content = $request->description;    // Main Content
        $description = $request->abstract;       // Sub Content
        $author = $request->author;
        $referer = $request->referer_links;
        $download_link = $request->download_link;
        $keywords = $request->keywords;

        // WIP: Check duplicate
        if (mb_strlen($content) >= 50 && Document::where("content_hash", "=", md5($content))->count() > 0) {
            Log::error("Duplicated Content");
            return response("Duplicated Content")->setStatusCode(400);
        }

        $document = Document::create([
            "title" => $title,
            "author" => implode(", ", $author),
            "description" => $description,
            "content_file" => "",
            "content_hash" => md5($content),
            "download_link" => $download_link,
            "referer" => $referer,
        ]);

        DocumentManager::updateContentFile($document, $content);
        DocumentManager::updateKeywords($document, $keywords);

        return response("Upload Successful")->setStatusCode(200);
    }
}
