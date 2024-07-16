<?php

namespace App\Exports;

use App\Models\Fournisseur;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBlack implements FromCollection
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     $token = $_COOKIE['token'] ?? null;
    //     $user = $_COOKIE['user']??null;
    //     $user_id = $_COOKIE['user_id'] ?? null;

    //     return Fournisseur::where('user_id',$user_id)->where('blaklist',true)->get();
    // }

    protected $selectedSupplierIds;

    public function __construct(array $selectedSupplierIds)
    {
        $this->selectedSupplierIds = $selectedSupplierIds;
    }
 /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user_id = $_COOKIE['user_id'] ?? null;

        if ($user_id) {
            if (!empty($this->selectedSupplierIds)) {
                return Fournisseur::whereIn('id', $this->selectedSupplierIds)
                                  ->where('user_id', $user_id)
                                  ->where('blaklist', true)
                                  ->get();
            } else {
                return Fournisseur::where('user_id', $user_id)
                                  ->where('blaklist', true)
                                  ->get();
            }
        } else {
            return collect([]);
        }
    }
}

