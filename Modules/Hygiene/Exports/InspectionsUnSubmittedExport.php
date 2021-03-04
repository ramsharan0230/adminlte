<?php
  
namespace Modules\Hygiene\Exports;
  
use Modules\Inspection\Entities\Inspection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;

use Auth;
  
class InspectionsUnSubmittedExport implements ShouldAutoSize, WithHeadings, FromArray
{
    private $branch;
    function __construct($branch) {
        $this->branch = $branch;
    }
    // use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
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

    public function array(): array
	{
        $inspections = Inspection::where('approvedBy_hygiene', 0)->where('user_id', Auth::id())->get(['id','location','start_date','findings','pca','accountibility', 'closing_date','status']);
        
        $data=[];
        $value=[];
        $i=1;
        foreach($inspections as $inspection){
            $value['id'] = $i;
            $value['location']=$inspection->location;
            $value['start_date']=$inspection->start_date;
            $value['findings']=$inspection->findings;
            $value['pca']=$inspection->pca;
            $value['accountibility']=$inspection->accountibility;
            $value['closing_date']=$inspection->closing_date;
            $value['status']=$inspection->start_date==0?"Close":"Open";

            array_push($data, $value);
            $i++;
        }
	        
        // dd($inspections);
	        return $data;
    }
}