<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Laporan Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('report-kegiatan.index') }}" class="text-white text-2xl font-semibold">Laporan Kegiatan</a>
            <div>
                <a href="{{ route('report-kegiatan.index') }}" class="text-white hover:underline">Dashboard</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto py-8 flex-1">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Tambah Detail Laporan Kegiatan</h1>

        <form action="{{ route('report-kegiatan.store-detail', $report->id) }}" method="POST" class="bg-white shadow-lg rounded-lg p-6" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="kategori" class="block text-gray-700">Judul</label>
                <input type="text" name="kategori" id="kategori" class="w-full px-4 py-2 mt-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="w-full px-4 py-2 mt-2 border rounded-lg" rows="4" placeholder="Masukkan deskripsi..." required></textarea>
            </div>

            <div class="mb-4">
                <label for="tanggal" class="block text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="w-full px-4 py-2 mt-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="foto" class="block text-gray-700">Foto</label>
                <input type="file" name="foto" id="foto" class="w-full px-4 py-2 mt-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 mt-2 border rounded-lg" required>
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            <div class="mt-6 text-center">
                <button type="submit" class="bg-green-500 text-white py-2 px-6 rounded-lg shadow hover:bg-green-600 transition">
                    Tambah Detail
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('report-kegiatan.index') }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow hover:bg-blue-600 transition">
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
