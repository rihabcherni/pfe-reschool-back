<?php

namespace App\Exports\ProductionPoubelle;

use App\Models\Materiau_primaire;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MateriauxPrimaireExport implements FromCollection , WithHeadings{
    public function headings():array{
        return[
            "ID",
            "ID fournisseur",
            "Carte identite national",
            "Nom fournisseur",
            "Nom materiel",
            "Prix unitaire",
            "Quantite",
            "Prix total",
            "Crée le",
            "Modifié le",
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Materiau_primaire::getMateriauxPrimaire());
    }
}