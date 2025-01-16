<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportKegiatansTable extends Migration
{
    public function up()
    {
        Schema::create('report_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama laporan
            $table->text('deskripsi')->nullable(); // Deskripsi laporan
            $table->string('status')->default('Draft'); // Status laporan (Draft/Selesai)
            $table->timestamps(); // Created at dan updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('report_kegiatans');
    }
}
