<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Laporan Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white text-2xl font-semibold">Laporan Kegiatan</a>
            <div>
                <a href="{{ route('report-kegiatan.index') }}" class="text-white">Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto py-8 flex-1">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Tambah Laporan Kegiatan</h1>
        <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-6">
            <form action="{{ route('report-kegiatan.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 font-medium">Nama Laporan</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama laporan" required>
                </div>

                <div class="mb-6">
                    <label for="deskripsi" class="block text-gray-700 font-medium">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Tambahkan deskripsi laporan (opsional)"></textarea>
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-lg shadow-lg hover:bg-blue-600 transition">
                        Simpan Laporan
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('report-kegiatan.index') }}" class="text-blue-500 hover:underline">Kembali ke Daftar Laporan</a>
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
