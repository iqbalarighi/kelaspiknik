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
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class NotelExport implements FromView, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $cari;

    public function __construct($cari, $count)
    {
        $this->cari = $cari;
        $this->count = $count;
    }

        public function styles(Worksheet $sheet)
    {   
        $count = $this->count+2;
        $sheet->getStyle('A2:H'.$count)->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1')->getFont()->setSize(16);
        $sheet->getStyle('A1:H2')->getFont()->setBold(true);
        $sheet->getStyle('A2:H2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('D3D3D3');
        $sheet->getStyle('A1:H2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1:H2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:H'.$count)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        return [
            "D3:E"."$count" => ['numberFormat' => ['formatCode' => NumberFormat::FORMAT_TEXT]],
            "G3:H"."$count" => ['numberFormat' => ['formatCode' => NumberFormat::FORMAT_TEXT]],
        ];
    }

    public function view(): View
    {
        $cari = $this->cari;

        $data = RegisterModel::with('trip')->whereRelation('trip', function ($query) use ($cari){
              $query->where('kode_trip', 'like', '%'.$cari.'%')
                     ->orWhere('nama_sekolah', 'LIKE', '%'.$cari.'%');
          })
         ->orWhere('nama_lengkap', 'LIKE', '%'.$cari.'%')
         ->orderBy('bus', 'asc')
         ->orderBy('nama_lengkap', 'asc')
         ->latest()
         ->paginate(100000000);
// dd($data);
        return view('dataregister.savenotelp', compact('data'));
    
    }
}
