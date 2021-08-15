<?php

namespace App\Models;

use App\Models\Catalog;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ukm extends Model implements Viewable
{
    use HasFactory;
    use InteractsWithViews;

    protected $table = 'ukms';

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    // public function incrementReadCount() {
    //     $this->reads++;
    //     return $this->save();
    // }
}
