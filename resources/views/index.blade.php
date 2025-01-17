<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white text-2xl font-semibold">Laporan Kegiatan</a>
            <div>
                <a href="{{ route('report-kegiatan.create') }}" class="text-white">Tambah Laporan</a>
            </div>
        </div>
    </nav>

    <div class="flex flex-1">
        <!-- Sidebar -->
        <div class="w-48 bg-gray-800 text-white p-4 h-screen shadow-lg transition-transform transform duration-300" id="sidebar">
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('report-kegiatan.index') }}" class="flex items-center py-2 px-4 rounded-md hover:bg-blue-700 hover:text-white transition-colors">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        <span class="text-sm">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/report-kegiatan" class="flex items-center py-2 px-4 rounded-md hover:bg-blue-700 hover:text-white transition-colors">
                        <i class="fas fa-clipboard-list mr-3"></i>
                        <span class="text-sm">Laporan</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center py-2 px-4 rounded-md hover:bg-blue-700 hover:text-white transition-colors">
                        <i class="fas fa-cogs mr-3"></i>
                        <span class="text-sm">Pengaturan</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="flex-1 p-8">
            <!-- Menampilkan Flash Message -->
            @if(session('success'))
                <div class="bg-green-500 text-white px-4 py-2 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Daftar Laporan Kegiatan</h1>
                <form action="{{ route('report-kegiatan.search') }}" method="GET" class="flex items-center space-x-2 w-full max-w-lg">
    <input 
        type="text" 
        name="query" 
        class="p-2 w-full rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
        placeholder="Cari laporan berdasarkan nama atau deskripsi..." 
        value="{{ request()->input('query') }}"
    >
    <button 
        type="submit" 
        class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow hover:bg-blue-600 flex items-center space-x-2"
    >
        <i class="fas fa-search"></i>
        <span>Cari</span>
    </button>
</form>

                <a href="{{ route('report-kegiatan.create') }}" class="bg-green-500 text-white py-2 px-4 rounded-lg shadow hover:bg-green-600 transition">
                    <i class="fas fa-plus-circle"></i> Tambah Laporan
                </a>
            </div>

            <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="px-4 py-3 text-left text-sm font-medium">Nama Laporan</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Deskripsi</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($reports as $report)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="px-4 py-3 text-gray-800">{{ $report->name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $report->deskripsi }}</td>
                        <td class="px-4 py-3">
                            @if($report->details->isEmpty())
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-600 text-xs rounded-full">No Entries</span>
                            @else
                                <span class="px-2 py-1 bg-green-100 text-green-600 text-xs rounded-full">Has Entries</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 flex space-x-2">
                            <a href="{{ route('report-kegiatan.show-details', $report->id) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('report-kegiatan.add-detail', $report->id) }}" class="text-green-500 hover:text-green-700">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                            <a href="{{ route('report-kegiatan.edit', $report->id) }}" class="text-yellow-500 hover:text-yellow-700">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('report-kegiatan.destroy', $report->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
