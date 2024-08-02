<?php

namespace App\Exports;

use App\Models\RegisterModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class DataregExport implements FromView, ShouldAutoSize, WithStyles
{

    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $cari;

    public function __construct($cari, $count)
    {
        $this->cari = $cari;
        $this->count = $count;
    }


    // public function drawings()
    // {
    //     $drawing = new Drawing();
    //     $drawing->setName('Kelas Piknik');
    //     $drawing->setDescription('Kelas Piknik');
    //     $drawing->setPath(public_path('storage/image/logo.png'));
    //     // $drawing->setWidth(80);
    //     $drawing->setHeight(80);
    //     $drawing->setCoordinates('B2');

    //     return $drawing;
    // }

    public function styles(Worksheet $sheet)
    {   
        $count = $this->count+2;
        $sheet->getStyle('A2:D'.$count)->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1')->getFont()->setSize(16);
        $sheet->getStyle('A1:D2')->getFont()->setBold(true);
        $sheet->getStyle('A2:D2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('D3D3D3');
        $sheet->getStyle('A1:D2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1:D2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:D'.$count)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    }

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
