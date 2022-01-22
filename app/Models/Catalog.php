<?php

namespace App\Models;

use App\Models\Ukm;
use App\Models\Click;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Catalog extends Model
{
    use HasFactory;

    public function ukm()
    {
        return $this->hasMany(Ukm::class);
    }

    public function click()
    {
        return $this->hasMany(Click::class);
    }
}
