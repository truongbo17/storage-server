<?php

namespace App\Services;

use App\Libs\DiskPathTools\DiskPathInfo;
use App\Libs\IdToPath;
use App\Libs\StringUtils;
use App\Models\Document;
use App\Models\Keyword;

class DocumentManager
{

    public static function updateContentFile(Document $document, string $content, bool $force = true)
    {
        if (!empty($document->content_file)) {
            if (!$force) return true;
            $path_info = $document->content_file;
            $new_file = false;
        } else {
            $disk = config('document.disk');
            $path = 'docs/' . IdToPath::make($document->id, 'txt');
            $path_info = new DiskPathInfo($disk, $path);
            $new_file = true;
        }

        if ($path_info->put($content)) {
            if ($new_file) {
                $document->content_file = $path_info;
                return $document->save();
            }
            return true;
        } else {
            \Log::error("Can't not update content for document [$document->id] : ");
            return false;
        }
    }

    public static function updateKeywords(Document $document, array $keywords)
    {
        $keywords_id = [];
        foreach ($keywords as $keyword) {
            if (mb_strlen($keyword) > 190 || empty($keyword)) continue;
            try {
                $entry = self::getKeyword($keyword);
                $id = $entry->id;
            } catch (\Exception) {
                continue;
            }
            if (in_array($id, $keywords_id)) continue;
            $keywords_id[] = $id;
        }
        //        $keywords_count = count($keywords_id);
        //        $document->update(['keywords_count' => $keywords_count]);
        $changed = $document->keywords()->sync($keywords_id);
        //        \DB::beginTransaction();
        //        if (count($changed['attached'])) {
        //            \DB::table('keywords')->whereIn('id', $changed['attached'])->increment('documents_count');
        //        }
        //        if (count($changed['detached'])) {
        //            \DB::table('keywords')->whereIn('id', $changed['detached'])->decrement('documents_count');
        //        }
        //        \DB::commit();

        return count($keywords_id);
    }

    /**
     * Find or create keyword from origin string
     *
     * @param string $string
     * @return Keyword
     */
    public static function getKeyword(string $string): Keyword
    {
        $content_hash = md5(StringUtils::normalize($string));

        return Keyword::firstOrCreate([
            'content_hash' => $content_hash,
        ], [
            'content' => StringUtils::trim($string),
            'length' => StringUtils::charactersCount($string),
        ]);
    }
}
