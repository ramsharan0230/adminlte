<?php
  
namespace Modules\Hygiene\Exports;
  
use Modules\Inspection\Entities\Inspection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Auth;
  
class InspectionsExport implements FromCollection, WithHeadings
{
    // use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inspection::where('approvedBy_hygiene', 1)->where('user_id', Auth::id())->get(
            [
                'id',
                'location',
                'start_date',
                'findings',
                'pca',
                'accountibility',
                'closing_date',
                'status'
            ]);
    }

    public function headings(): array
    {
        return [
            '#',
            'Location',
            'Start Date',
            'Findings',
            'Proposed Corrective Action',
            'Accountibility',
            'Closing Date',
            'Status'
        ];
    }
}