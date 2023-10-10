<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Inventario;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventarioExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Inventario::all();
        return Inventario::get(['id','nombre', 'cantidad', 'precio']);
    }

    public function headings(): array
    {
        return ["Id","Nombre", "Cantidad", "Precio"];
    }
}
