<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportKegiatanDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('report_kegiatan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_kegiatan_id')->constrained()->onDelete('cascade'); // Relasi ke laporan kegiatan
            $table->string('kategori'); // Kategori detail
            $table->date('tanggal'); // Tanggal kegiatan
            $table->text('deskripsi'); // Deskripsi detail
            $table->string('status'); // Status detail (Selesai/Pending)
            $table->string('foto')->nullable(); // File foto (opsional)
            $table->timestamps(); // Created at dan updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('report_kegiatan_details');
    }
}
