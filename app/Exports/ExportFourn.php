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
        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;
        
        return Fournisseur::where('user_id',$user_id)->where('blaklist',false)->paginate(5);
    }
}
