<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportKegiatan extends Model
{
    use HasFactory;
      
    protected $fillable = ['name', 'deskripsi', 'status'];

    public function details()
    {
        return $this->hasMany(ReportKegiatanDetail::class);
    }

    // public function progress()
    // {
    //     $totalDetails = $this->details->count();
    //     return $totalDetails > 0 ? round($totalDetails / 10 * 100, 2) : 0; // Misal 10 detail sebagai target
    // }
}