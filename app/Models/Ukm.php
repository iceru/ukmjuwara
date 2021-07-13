<?php

namespace App\Models;

use App\Models\Catalog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ukm extends Model
{
    use HasFactory;

    protected $table = 'ukms';

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }
}
