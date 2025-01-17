<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom hover effect for rows */
        .table-row:hover {
            background-color: #f3f4f6;
            transition: background-color 0.3s ease-in-out;
        }
        /* Highlight alternating rows */
        .table-row:nth-child(even) {
            background-color: #f9fafb;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-500 to-blue-700 shadow-lg p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('report-kegiatan.index') }}" class="text-white text-2xl font-semibold">
                <i class="fas fa-book"></i> Laporan Kegiatan
            </a>
            <div>
                <a href="{{ route('report-kegiatan.index') }}" class="text-white hover:underline">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto py-8 flex-1">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Detail Laporan: {{ $report->name }}</h1>

        <!-- Session Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 shadow" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 shadow" role="alert">
                <strong class="font-bold">Gagal!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex justify-end mb-6">
            <a href="{{ route('report-kegiatan.add-detail', $report->id) }}" 
               class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300 flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Detail
            </a>
            <a href="{{ route('report-kegiatan.export-excel', $report->id) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300 ml-4 flex items-center">
                <i class="fas fa-file-excel mr-2"></i> Export ke Excel
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Judul</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Foto</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($details as $detail)
                        <tr class="table-row">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $detail->kategori }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $detail->tanggal }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $detail->deskripsi }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($detail->foto)
                                    <img src="{{ asset('foto_laporan/' . $detail->foto) }}" alt="Foto" 
                                         class="w-20 h-20 object-cover rounded-lg shadow-lg">
                                @else
                                    <span class="text-gray-500 italic">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $detail->status === 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $detail->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex items-center space-x-3">
                                <!-- Tombol Edit -->
                                <a href="{{ route('report-kegiatan.details.edit', $detail->id) }}" 
                                   class="text-yellow-500 hover:text-yellow-600 transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('report-kegiatan.details.destroy', $detail->id) }}" method="POST" 
                                      class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus detail laporan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">
                                Belum ada detail laporan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('report-kegiatan.index') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Laporan
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white p-4 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Laporan Kegiatan | All rights reserved</p>
        </div>
    </footer>

</body>
</html>
