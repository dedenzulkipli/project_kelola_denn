<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('report-kegiatan.index') }}" class="text-white text-2xl font-semibold">Laporan Kegiatan</a>
            <div>
                <a href="{{ route('report-kegiatan.index') }}" class="text-white hover:underline">Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto py-8 flex-1">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Detail Laporan: {{ $report->name }}</h1>

        <!-- Session Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Gagal!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="mb-6 text-right">
            <a href="{{ route('report-kegiatan.add-detail', $report->id) }}" 
               class="bg-green-500 text-white py-2 px-4 rounded-lg shadow hover:bg-green-600 transition">
                Tambah Detail
            </a>
            <a href="{{ route('report-kegiatan.export-excel', $report->id) }}" 
               class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow hover:bg-blue-600 transition">
                Export ke Excel
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Judul</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Tanggal</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Deskripsi</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Foto</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Status</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($details as $detail)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $detail->kategori }}</td>
                        <td class="px-4 py-2">{{ $detail->tanggal }}</td>
                        <td class="px-4 py-2">{{ $detail->deskripsi }}</td>
                        <td class="px-4 py-2">
                            @if($detail->foto)
                                <img src="{{ asset('foto_laporan/' . $detail->foto) }}" alt="Foto" class="w-32 h-32 object-cover rounded-md">
                            @else
                                <span class="text-gray-500 italic">Tidak ada foto</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <span class="{{ $detail->status === 'Selesai' ? 'text-green-500' : 'text-yellow-500' }}">
                                {{ $detail->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center gap-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('report-kegiatan.details.edit', $detail->id) }}" 
                                   class="bg-yellow-500 text-white p-2 rounded-lg shadow hover:bg-yellow-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12h2m-6 0H9m0 0v2m0-4v2m-6 4a9 9 0 1118 0H3z" />
                                    </svg>
                                </a>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('report-kegiatan.details.destroy', $detail->id) }}" method="POST" 
                                      class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus detail laporan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 text-white p-2 rounded-lg shadow hover:bg-red-600 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4m16 0H4m16 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500 italic">Belum ada detail laporan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Back Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('report-kegiatan.index') }}" 
               class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow hover:bg-blue-600 transition">
                Kembali ke Daftar Laporan
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white p-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Laporan Kegiatan | All rights reserved</p>
        </div>
    </footer>

</body>
</html>
