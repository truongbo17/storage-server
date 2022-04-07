<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Keyword extends Model
{
    protected $fillable = ["content", "content_hash", 'length'];
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    /**
     * The roles that belong to the Keyword
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, 'document_keyword', 'keyword_id', 'document_id');
    }
}
