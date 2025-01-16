<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportKegiatanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_kegiatan_id', 'kategori', 'deskripsi', 'tanggal', 'status', 'foto'
    ];

    public function reportKegiatan()
    {
        return $this->belongsTo(ReportKegiatan::class);
    }
}
