<?php

namespace App\Exports;

use App\Models\RegisterModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataregExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RegisterModel::all();
    }
}
