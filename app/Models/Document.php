<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use ElasticScoutDriverPlus\Searchable;
use App\Libs\DiskPathTools\DiskPathInfo;

class Document extends Model
{
    use Searchable;

    protected $fillable = [
        'title',
        'author',
        'description',
        'download_link',
        'referer',
        'content_file',
        'content_hash',
    ];
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;


    protected $mapping = [
        'properties' => [
            'title' => [
                'type' => 'text'
            ],
            'content' => [
                'type' => 'text'
            ],
        ]
    ];

    public function toSearchableArray()
    {
        $array = [
            'title' => $this->title,
            'content' => $this->content_file ? DiskPathInfo::parse($this->content_file)->read() : null,
        ];

        return $array;
    }

    /**
     * The roles that belong to the Document
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class, 'document_keyword', 'document_id', 'keyword_id');
    }
}
