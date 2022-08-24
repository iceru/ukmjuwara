<?php

namespace App\Models;

use App\Models\Ukm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UkmSlider extends Model
{
    use HasFactory;

    public function ukm()
    {
        return $this->belongsTo(Ukm::class);
    }
}
