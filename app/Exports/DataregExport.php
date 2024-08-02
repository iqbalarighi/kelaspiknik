<?php

namespace App\Exports;

use App\Models\RegisterModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class DataregExport implements FromView, ShouldAutoSize
{

    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $cari;

    public function __construct($cari)
    {
        $this->cari = $cari;
    }


    // public function drawings()
    // {
    //     $drawing = new Drawing();
    //     $drawing->setName('OJK');
    //     $drawing->setDescription('Otoritas Jasa Keuangan');
    //     $drawing->setPath(public_path('storage/img/logo-ojk.png'));
    //     $drawing->setWidth(133);
    //     $drawing->setCoordinates('B2');

    //     return $drawing;
    // }

    // public function styles(Worksheet $sheet)
    // {   
    //     $count = $this->count+5;
    //     $sheet->getStyle('A5:N'.$count)->getAlignment()->setWrapText(true);
    //     $sheet->getStyle('A2')->getFont()->setSize(16);
    //     $sheet->getStyle('A1:N5')->getFont()->setBold(true);
    //     $sheet->getStyle('A5:N5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('D3D3D3');
    //     $sheet->getStyle('A5:N'.$count)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    // }

    public function view(): View
    {
        $cari = $this->cari;


        $data = RegisterModel::where('kode_trip', 'LIKE', '%'.$cari.'%')
         ->orWhere('nama_lengkap', 'LIKE', '%'.$cari.'%')
         ->orWhere('sekolah', 'LIKE', '%'.$cari.'%')
         ->latest()
         ->paginate(100000000);
// dd($data);
        return view('dataregister.savexcel', compact('data'));
    
    }
}
