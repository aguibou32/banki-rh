<?php

namespace App\Imports;

use App\Models\Presence;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PresencesImport implements ToModel, SkipsEmptyRows
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Presence([
            'emp_no'=> $row[0],
            'ac_no'=> $row[1], 
            'no'=> $row[2], 
            'name'=> $row[3], 
            'auto_assign' => $row[4],
            'date' => $row[5],
            'timetable' => $row[6],

        ]);
    }

    public function rules(): array
    {
      
    }


}
