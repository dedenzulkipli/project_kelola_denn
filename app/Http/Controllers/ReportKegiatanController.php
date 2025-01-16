<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportKegiatan;
use App\Models\ReportKegiatanDetail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportDetailExport;


class ReportKegiatanController extends Controller
{
    public function index()
    {
        $reports = ReportKegiatan::all(); // Menampilkan semua laporan
        return view('index', compact('reports'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);
    
        $report = ReportKegiatan::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'status' => 'No Entries',
        ]);
    
        // Menambahkan flash message untuk keberhasilan
        session()->flash('success', 'Laporan kegiatan berhasil ditambahkan.');
    
        return redirect()->route('report-kegiatan.index');
    }    
    public function edit($id)
    {
        $report = ReportKegiatan::findOrFail($id);
        return view('edit', compact('report'));
    }

    // Method untuk update laporan
    public function update(Request $request, $id)
    {
        $report = ReportKegiatan::findOrFail($id);
        $report->update($request->all());
        return redirect()->route('report-kegiatan.index')->with('success', 'Laporan berhasil diperbarui');
    }
    public function destroy($id)
    {
        // Temukan laporan berdasarkan ID
        $report = ReportKegiatan::findOrFail($id);
    
        // Hapus laporan
        $report->delete();
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('report-kegiatan.index')->with('success', 'Laporan kegiatan berhasil dihapus.');
    }
    public function search(Request $request)
    {
        // Get the search query from the request
        $query = $request->input('query');
        
        // Perform search in 'name' and 'deskripsi' columns
        $reports = ReportKegiatan::where('name', 'like', "%$query%")
            ->orWhere('deskripsi', 'like', "%$query%")
            ->get();

        // Return the results to the view
        return view('index', compact('reports'));
    }
    

    public function addDetail($id)
    {
        $report = ReportKegiatan::findOrFail($id); // Temukan laporan berdasarkan ID
        return view('add-detail', compact('report'));
    }

    public function storeDetail(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|string|in:Selesai,Pending',
        ]);
    
        $report = ReportKegiatan::findOrFail($id);
    
        // Handle file upload jika ada
        $fileName = null;
        if ($request->hasFile('foto')) {
            $fileName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('foto_laporan'), $fileName);
        }
    
        $report->details()->create([
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi, // Simpan deskripsi
            'status' => $request->status,
            'foto' => $fileName,
        ]);
    
        return redirect()->route('report-kegiatan.show-details', $report->id)->with('success', 'Detail laporan berhasil ditambahkan.');
    }
    
    
    public function showDetails($id)
    {
        $report = ReportKegiatan::findOrFail($id); // Temukan laporan berdasarkan ID
        $details = $report->details; // Mengambil semua detail terkait laporan
        return view('show-details', compact('report', 'details'));
    }

    public function exportExcel($id)
    {
        $report = ReportKegiatan::findOrFail($id);

        // Nama file Excel yang akan diunduh
        $fileName = 'Detail_Laporan_' . $report->name . '.xlsx';

        // Ekspor data ke Excel
        return Excel::download(new ReportDetailExport($id), $fileName);
    }

    
}
