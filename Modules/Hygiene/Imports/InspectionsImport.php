<?php
  
namespace Modules\Hygiene\Imports;
  
use Modules\Inspection\Entities\Inspection;
use Maatwebsite\Excel\Concerns\ToModel;
  
class InspectionsImport implements ToModel
{
    /**
    * @param array $row
    *y
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Inspection([
            'name'     => $row[0],
            'email'    => $row[1], 
            'password' => \Hash::make('123456'),
        ]);
    }
}