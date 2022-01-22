<?php

namespace App\Models;

use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Click extends Model
{
    use HasFactory;

    protected $fillable = ['catalog_id', 'type_click', 'name_click', 'clicks', 'category_id'];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
