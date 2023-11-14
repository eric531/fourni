<?php

namespace App\Exports;

use App\Models\Fournisseur;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportFourn implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Fournisseur::all();
    }
}
