<?php

namespace App\Models;

use App\Models\Catalog;
use App\Models\Category;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ukm extends Model implements Viewable, Searchable
{
    use HasFactory;
    use InteractsWithViews;

    protected $table = 'ukms';

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'ukm_category', 'ukm_id', 'category_id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('ukm.show', $this->slug);

        return new SearchResult(
            $this,
            $this->title,
            $url
         );
    }

}
