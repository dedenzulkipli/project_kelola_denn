<?php

namespace App\Exports;

use App\Models\ReportKegiatan;
use App\Models\ReportKegiatanDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportDetailExport implements FromCollection, WithHeadings, WithMapping
{
    protected $reportId;

    public function __construct($reportId)
    {
        $this->reportId = $reportId;
    }

    public function collection()
    {
        return ReportKegiatanDetail::where('report_kegiatan_id', $this->reportId)->get();
    }

    public function map($detail): array
    {
        $report = ReportKegiatan::find($this->reportId);

        return [
            $report->name,                             // Nama report utama
            $detail->kategori,                        // Kolom kategori
            $detail->tanggal,                         // Kolom tanggal
            $detail->deskripsi,                       // Kolom deskripsi
            $detail->status,                          // Kolom status
            $detail->foto ? asset('foto_laporan/' . $detail->foto) : 'Tidak Ada Foto'// Hyperlink ke foto
        ];
    }

    public function headings(): array
    {
        return ['Nama Report', 'Judul', 'Tanggal', 'Deskripsi', 'Status', 'Foto'];
    }
}
