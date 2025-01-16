
# REPORT KEGIATAN

# FITUR UTAMA
 

 -Menambahakan laporan Kegiatan utama(Header)
 
 -Menambahakan detail untuk setiap laporan(On-To-Many)

 -Menampilkan semua laporan dan detail yang terkait

 -Menambah,Mengahapus dan Memperbarui Laporan kegiatan

 -Menambahakan foto untuk detail laporan kegiatan

 -Fitur Pencarian berdasarkan nama dan deskripsi

 -Export Laporan kegiatan ke format excel


# PERSYARATAN 

 Sebelum memulai, pastikan Anda memiliki perangkat dan 
 perangkat lunak berikut:

 -PHP 8.0 atau lebih baru
 
 -Composer untuk mengelola dependensi PHP

 -Laravel 10

 -Database pake MySQl

 -Maatwebsite Excel (untuk ekspor data ke Excel)

# Instalasi dan Konfigurasi
1. Kloning Repositori

 # git clone https://github.com/username/repo-laporan-kegiatan.git
Masuk ke direktori proyek:

 # cd repo-laporan-kegiatan
2. Instal Dependensi
Instal dependensi yang diperlukan dengan Composer:

 # composer install
3. Pengaturan File .env
Salin file .env.example menjadi .env:

 # cp .env.example .env
Edit file .env dan sesuaikan konfigurasi database MySQL


 # DB_CONNECTION=mysql
 # DB_HOST=127.0.0.1
 # DB_PORT=3306
 # DB_DATABASE=db_kelola
 # DB_USERNAME=root
 # DB_PASSWORD=
4. Generate Key Aplikasi
Jalankan perintah berikut untuk menghasilkan kunci aplikasi Laravel:


 # php artisan key:generate
5. Jalankan Migrasi Database
Jika Anda belum membuat database, buatlah terlebih dahulu. Setelah itu jalankan perintah untuk migrasi tabel:

 # php artisan migrate
6. Menambahkan Data Awal (Opsional)
Jika Anda ingin mengisi data awal, Anda dapat membuat seeder:


 # php artisan db:seed
7. Menjalankan Aplikasi
Jalankan aplikasi Laravel menggunakan server built-in:

 # php artisan serve
Akses aplikasi di 
# http://127.0.0.1:8000.



# STRUKTUR Database

Tabel report_kegiatans

id (Primary Key)

name: Nama laporan.

deskripsi: Deskripsi laporan.

status: Status laporan (No Entries / Complete).

created_at: Timestamp pembuatan.

updated_at: Timestamp pembaruan.

Tabel report_kegiatan_details

id (Primary Key)

report_kegiatan_id: Foreign Key ke report_kegiatans.

kategori: Kategori detail.

tanggal: Tanggal detail.

deskripsi: Deskripsi detail.

foto: Path foto detail.

status: Status detail (Selesai / Pending).

created_at: Timestamp pembuatan.

updated_at: Timestamp pembaruan.


# Langkah Pengembangan Fitur

# 1. Membuat Model dan Migrasi

**Model **ReportKegiatan

 # php artisan make:model ReportKegiatan -m

**Model **ReportKegiatanDetail

 # php artisan make:model ReportKegiatanDetail -m

Edit migrasi di database/migrations untuk membuat tabel report_kegiatans dan report_kegiatan_details.

Lalu jalankan:

php artisan migrate

# 2. Membuat Controller

**Controller **ReportKegiatanController

# php artisan make:controller ReportKegiatanController
# php artisan make:controller ReportKegiatanDetailController

Tambahkan semua fungsi CRUD, ekspor Excel, dan RAR di controller ini.

# 3. Membuat View

Buat folder resources/views/report-kegiatan untuk menyimpan file Blade, seperti:

index.blade.php (Daftar laporan)

create.blade.php (Form tambah laporan)

edit.blade.php (Form edit laporan)

show-details.blade.php (Detail laporan )

add-detail.blade.php (Form tambah detail laporan)

edit_detail.blade.php (Form Edit Detail )

# 4. Menambahkan Rute

Tambahkan rute di routes/web.php:

Route::resource('report-kegiatan', ReportKegiatanController::class);
Route::get('report-kegiatan/{id}/export-excel', [ReportKegiatanController::class, 'exportExcel'])->name('report-kegiatan.export-excel');
Route::get('report-kegiatan/{id}/export-rar', [ReportKegiatanController::class, 'exportRar'])->name('report-kegiatan.export-rar');

# 5. Ekspor ke Excel

Gunakan pustaka Maatwebsite Excel:

composer require maatwebsite/excel

Buat ReportDetailExport di App/Exports untuk menangani ekspor data ke Excel.

# Testing

Jalankan server lokal:

php artisan serve

Akses aplikasi dan coba semua fitur CRUD serta ekspor.

# PENGGUNAAN
 
# 1.Menambahkan Laporan Kegiatan:

 -Masuk ke aplikasi dan pilih opsi untuk membuat laporan kegiatan baru

 -Isi nama dan deskripsi laporan kegiatan.

# 2.Menambahkan Detail Laporan:

-Setelah laporan dibuat, Anda dapat menambahkan    detail terkait laporan tersebut (kategori, tanggal, deskripsi, status).

# 3.Melihat Detail Laporan:

-Anda dapat melihat laporan kegiatan beserta detail terkaitnya.

# 4.Menghapus dan Memperbarui Laporan:

-Anda dapat menghapus laporan kegiatan atau memperbarui informasi laporan.

# 5.Ekspor Laporan ke Excel:

Gunakan fitur ekspor untuk mengunduh laporan kegiatan beserta detailnya dalam format Excel.


