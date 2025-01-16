<?php

namespace App\Http\Controllers;

use App\Models\ReportKegiatanDetail;
use Illuminate\Http\Request;

class ReportKegiatanDetailController extends Controller
{
    // Method untuk update detail laporan
    public function edit($id)
    {
        $detail = ReportKegiatanDetail::findOrFail($id);
        return view('edit_detail', compact('detail'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'status' => 'required|string|in:Selesai,Pending',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $detail = ReportKegiatanDetail::findOrFail($id);
        $detail->kategori = $request->kategori;
        $detail->deskripsi = $request->deskripsi;
        $detail->tanggal = $request->tanggal;
        $detail->status = $request->status;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($detail->foto) {
                unlink(public_path('foto_laporan/' . $detail->foto));
            }

            // Upload foto baru
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('foto_laporan'), $filename);
            $detail->foto = $filename;
        }

        $detail->save();

        return redirect()->route('report-kegiatan.show-details', $detail->report_kegiatan_id)
                         ->with('success', 'Detail laporan berhasil diperbarui');
    }

    // Method untuk menghapus detail laporan
    public function destroy($id)
    {
        $detail = ReportKegiatanDetail::findOrFail($id);
        
        // Hapus foto jika ada
        if ($detail->foto) {
            unlink(public_path('foto_laporan/' . $detail->foto));
        }
        
        $detail->delete();
        
        return redirect()->route('report-kegiatan.show-details', $detail->report_kegiatan_id)
                         ->with('success', 'Detail laporan berhasil dihapus');
    }
}
