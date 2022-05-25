<?php

namespace App\Models;

use App\Models\Ukm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    public function ukm()
    {
        return $this->hasMany(Ukm::class);
    }

}
