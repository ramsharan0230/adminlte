<?php
  
namespace Modules\Hygiene\Exports;
  
use Modules\Inspection\Entities\Inspection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

use Auth;
  
class InspectionsExport implements ShouldAutoSize, WithHeadings, FromArray
{
    // use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    private $start_date;
    private $end_date;
    private $branch_id;
    private $drawing;

    public function __construct(string $start_date, string $end_date, int $branch_id) 
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->branch_id = $branch_id;
        $this->drawing = new Drawing();

        // $this->drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    }
    
    // public function drawings()
    // {
    //     $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    //     $drawing->setName('Logo');
    //     $drawing->setPath(public_path('images/inspection_file/pictures').'/'.'photo1.png');
    //     $drawing->setHeight(120);

    //    return $drawing;
    // }

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
            // 'Photo',
            'Status'
        ];
    }

    public function array(): array
	{
        $inspections = Inspection::where('branch_id', $this->branch_id)->whereBetween('created_at', [$this->start_date, $this->end_date])
            ->with('pictures')
            ->get(['id','location','start_date','findings','pca','accountibility', 'closing_date','status']);

            
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

            // foreach($inspection->pictures as $key=>$photo){
            //     // $value['photo'][$key] = $this->drawing->setPath(public_path('images/inspection_file/pictures').'/'.$photo->name);
            //     $value['photo'][$key] = $photo->name;
            // }

            $value['status']=$inspection->start_date==0?"Close":"Open";

            array_push($data, $value);
            $i++;
        }
	        
        // dd($inspections);
	        return $data;
    }
}