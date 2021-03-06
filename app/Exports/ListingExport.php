<?php


namespace App\Exports;


use App\Results;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ListingExport implements FromCollection, WithHeadings
{

    /**
     * @return Collection
     */
    public function collection()
    {
        return Results::distinct()->where('squareMeterPrice', '>', 0)->where('squareMeterPrice', '<', 3000)->whereDate('created_at',date('Y-m-d'))->orderBy('squareMeterPrice')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Website',
            'URL',
            'Postcode',
            'price',
            'price/m2',
            'location',
            'type',
            'm2',
            '# of rooms',
            '# of bedrooms',
            'Description',
            'Date and Time Created',
            'Date and Time Update',
        ];
    }
}
