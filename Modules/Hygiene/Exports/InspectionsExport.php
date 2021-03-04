<?php
  
namespace Modules\Hygiene\Exports;
  
use Modules\Inspection\Entities\Inspection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;

use Auth;
  
class InspectionsExport implements ShouldAutoSize, WithHeadings, FromArray
{
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
        if(\Auth::user()->role->slug =='site-manager')
            $inspections = Inspection::where('approvedBy_hygiene', 1)->where('approvedBy_siteman', 1)->where('user_id', Auth::id())->get(['id','location','start_date','findings','pca','accountibility', 'closing_date','status']);
        
        if(\Auth::user()->role->slug =='hygiene')
            $inspections = Inspection::where('approvedBy_hygiene', 1)->where('user_id', Auth::id())->get(['id','location','start_date','findings','pca','accountibility', 'closing_date','status']);

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