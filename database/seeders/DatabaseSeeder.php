<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\File;
use App\Models\Document;
use App\Models\Keyword;
use App\Services\DocumentManager;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Document::truncate();
        Keyword::truncate();

        $file = File::get("database/data/documents.json");
        $data = json_decode($file, true);

        foreach ($data as $value) {
            foreach ($value as $item) {
                $title         = $item["title"];
                $description   = $item["description"];
                $abstract      = $item["abstract"];
                $author        = $item["author"];
                $referer       = $item["referer"];
                $download_link = $item["download_link"];
                $keywords      = $item["keywords"];

                if (Document::where("content_hash", "=", md5($description))->count() > 0) {
                    return;
                };

                $document = Document::create([
                    "title"         => $title,
                    "author"        => implode(",", $author),
                    "description"   => $abstract,
                    "content_file"  => "",
                    "content_hash"  => md5($description),
                    "download_link" => $download_link,
                    "referer"       => $referer,
                ]);

                DocumentManager::updateContentFile($document, $description);
                DocumentManager::updateKeywords($document, $keywords);
            }
        }
    }
}
