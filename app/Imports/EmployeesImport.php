<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Admin\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;

class EmployeesImport implements ToModel,WithHeadingRow,WithUpserts,WithUpsertColumns

{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'names' => $row['names'], 
            'surname' => $row['surname'],
            'ID_Card' => $row['id-card'],
            'department' => $row['department'],
            'category' => $row['category'],
            'location' => $row['location'],
            'gender' => $row['gender'],
            'phone' => $row['phone'],
            'position' => $row['position'],
            'status' => "OUT",
            'dateJoined' => Carbon::now(),
            'latestTap' => Carbon::now()
        ]);

    }


    public function uniqueBy()
    {
        return 'email';
    }

    public function upsertColumns()
    {
        return ['department', 'phone','location', 'category', 'position'];
    }
}
