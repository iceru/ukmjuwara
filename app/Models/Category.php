<?php

namespace App\Models;

use App\Models\Ukm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function ukms()
    {
        return $this->belongsToMany(Ukm::class, 'ukm_category', 'category_id', 'ukm_id');
    }

}
