<?php


namespace App\Exports;


use App\Results;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ListingExport implements FromCollection
{

    /**
     * @return Collection
     */
    public function collection()
    {
        return Results::all();
    }
}
