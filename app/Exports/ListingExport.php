<?php


namespace App\Exports;


use App\Results;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ListingExport implements FromCollection,WithHeadings
{

    /**
     * @return Collection
     */
    public function collection()
    {
        return Results::all();
    }
    public function headings(): array
    {
        return [
            '#',
            'Website',
            'Postcode',
            'URL',
            'price',
            'price',
            'price',
            'location',
            'type',
            'm2',
            '# of rooms',
            '# of bedrooms',
        ];
    }
}
