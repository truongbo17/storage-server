<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Document extends Model
{
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
