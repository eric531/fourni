<?php

namespace App\Exports;

use App\Models\Draft;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportDraft implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;
        
        return Draft::where('user_id',$user_id)->get();
    }
}
