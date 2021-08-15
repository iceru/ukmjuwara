<?php

namespace App\Models;

use App\Models\Tag;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model implements Searchable
{
    use HasFactory;

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'articles_tags', 'article_id', 'tag_id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('article.show', $this->slug);

        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}
