<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fournisseur;

class FournisseursTableSeeder extends Seeder
{
    public function run()
    {
        Fournisseur::create([
            'name' => 'Fournisseur 1',
            'domaine' => 'Domaine 1',
            'contact' => 'Contact 1',
            'email' => 'fournisseur1@example.com',
            'code_fournisseur' => 'FOUR-001',
        ]);

        Fournisseur::create([
            'name' => 'Fournisseur 2',
            'domaine' => 'Domaine 2',
            'contact' => 'Contact 2',
            'email' => 'fournisseur2@example.com',
            'code_fournisseur' => 'FOUR-002',
        ]);

        Fournisseur::create([
            'name' => 'Fournisseur 3',
            'domaine' => 'Domaine 3',
            'contact' => 'Contact 3',
            'email' => 'fournisseur3@example.com',
            'code_fournisseur' => 'FOUR-003',
        ]);

        Fournisseur::create([
            'name' => 'Fournisseur 4',
            'domaine' => 'Domaine 4',
            'contact' => 'Contact 4',
            'email' => 'fournisseur4@example.com',
            'code_fournisseur' => 'FOUR-004',
        ]);
    }
}
