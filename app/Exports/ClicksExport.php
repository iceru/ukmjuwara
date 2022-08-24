<?php

namespace App\Exports;

use App\Models\Click;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClicksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Click::all();
    }
}
