# Ringkasan Teknis & Arsitektur INDETA

### 1. Stack Teknologi Utama

- **Backend / Routing Server:** Laravel 12 (PHP 8.2+) yang difungsikan lebih sebagai pelayan Static Route / Skeleton berbasis _Client-Side Rendering_ (CSR).
- **Frontend:** _Template engine_ Blade, Vite, Tailwind CSS v4, dikombinasikan dengan **Supabase JS SDK** untuk manipulasi data antar-muka (_fetching_ dinamis).
- **Database & Storage:** Supabase (PostgreSQL) serta bucket Supabase Storage, diakses langsung dari lapisan JavaScript.
- **Infrastruktur Deployment:** Vercel (terlihat dari konfigurasi `vercel.json`, _routing_ `api/index.php`, dan skrip _build_ di `package.json`).

### 2. Pemetaan Integrasi Supabase MCP

Pada proyek ini, Supabase MCP (Model Context Protocol) **bukanlah dependensi aplikasi saat berjalan (_runtime_)**, melainkan alat bantu untuk mempermudah pengembangan (_Developer Experience_ / DX) di tingkat editor kode:

- **Lokasi:** Dikonfigurasi dalam berkas `.vscode/mcp.json`.
- **Tujuan:** Menghubungkan _environment_ pengembangan (seperti AI asisten di VS Code) secara langsung ke proyek Supabase.
- **Penggunaan:** Karena disetel ke `read_only=false` dengan fitur `database,docs`, AI dapat membaca skema Supabase yang aktif. Aplikasi itu sendiri tetap berjalan menggunakan koneksi normal (melalui _connection pooler_ di `.env`).

### 3. Alur Data, Logika Aplikasi, & Struktur Database

- **Kondisi Saat Ini:** Arsitektur proyek menggunakan pola perpaduan antara kerangka Laravel (untuk Routing) dan BaaS (_Backend-as-a-Service_) dari Supabase.
- **Routing & Rendering (CSR):** Alur data menggunakan _direct routing_ dari `routes/web.php` menuju berkas antarmuka (mis: `user.destinasi_detail`). Di sisi klien, JavaScript melalui Supabase SDK mengambil alih tugas _fetch_ dari tabel maupun instalasi media _bucket_. Direktori `app/Http/Controllers/` tidak difungsikan karena rendering diatasi secara _Client-Side_.
- **Database & Migrasi (Supabase Aktif):** Database Supabase **telah memuat data operasional (tidak kosong)**. Pada `public` schema terdapat tabel-tabel terelasi:
    - `users` (Akses & Author), `destinations` (Objek wisata & referensi), `umkm_products`, `tour_packages`, `articles`, `galleries`, `testimonials`, `reviews`, `contacts`, dan `web_contents` (konfigurasi).
    - Skrip migrasi lokal Laravel (`database/migrations`) telah tertinggal/tidak sinkron dengan keadaan database _live_ ini.
- **Storage Buckets:** Pengelolaan media dipisah ke bucket-bucket _public_: `indeta_assets`, `destinations`, `umkm_products`, `tour_packages`, dan `articles`.

### 4. Titik Lemah (Bottleneck) & Observasi Arsitektur

- **Kerawanan Data Publik (KRITIS - RLS):** Hampir semua tabel utama (`users`, `destinations`, `articles`, `web_contents`, dll) **belum mengaktifkan Row Level Security (RLS)**. Karena aplikasi ini memanggil database langsung via _Frontend_ (Anon Key), pihak tidak bertanggung jawab bisa dengan mudah memanipulasi atau menghapus seluruh isi data database dari _browser console_ mereka.
- **Vercel Serverless + Laravel:** Mende-deploy aplikasi monolitik seperti Laravel ke Vercel (sebagai _serverless functions_) memiliki tantangan khusus. Secara bawaan, Laravel membutuhkan _file system_ yang konsisten. Konfigurasi _session_ dan _cache_ harus dijalankan ke _database_, _cookie_, atau Redis karena lingkungan _serverless_ bersifat _stateless_.
- **Connection Pooling:** Sudah menggunakan URL _pooler_ Supabase (`aws-1-ap-southeast-1.pooler...`) di berkas `.env`. Ini keputuan jitu jika ada injeksi _backend_ agar limit koneksi postgreSQL tetap aman.
- **Keamanan:** Terdapat berkas `pass supabase.txt` serta kredensial asli di `.env`. Pastikan berkas-berkas ini terdaftar di dalam `.gitignore` agar tidak terunggah ke repositori Git publik.

### 5. Ringkasan Fitur Aplikasi (Berdasarkan Kode & Konsep)

Aplikasi ini tidak sekadar menjadi brosur wisata digital, tetapi menjadi panduan praktis (_all-in-one_) yang mempermudah perjalanan wisatawan—mulai dari mencari rute, mengecek harga tiket, melihat ulasan, hingga menghubungi pengelola dan membeli suvenir khas dari UMKM setempat secara langsung. Berikut adalah cakupan fiturnya:

- **Sistem Autentikasi (Login/Register)**
  Antarmuka untuk pendaftaran dan akses masuk pengguna (`login.blade.php` & `register.blade.php`). Penting untuk memvalidasi interaksi pengguna (seperti memberikan _rating/review_) dan membatasi akses dasbor.
- **Dashboard Admin (CMS)**
  Area pengelolaan di balik layar (`admin/dashboard.blade.php`) bagi pengelola sistem/web untuk mengatur data destinasi, memperbarui Kategori, mempublikasikan artikel, dan memverifikasi data produk UMKM.
- **Fitur Destinasi**
  Katalog desa atau tempat wisata yang lengkap (`user/destinasi.blade.php` & `destinasi_detail.blade.php`), menyajikan:
    - Deskripsi, fasilitas, dan jam operasional.
    - Harga tiket (disajikan praktis berupa gambar).
    - Tombol navigasi langsung ke Google Maps.
    - _Rating_ dan _review_.
    - Tautan kontak layar (_direct link_) menuju WhatsApp/kontak reservasi tanpa _copy-paste_.
- **Fitur Produk Khas (UMKM)**
  Sub-katalog di dalam destinasi (atau independen) yang mempromosikan barang lokal (kerajinan, kopi, dll) dengan transparansi harga dan deskripsi, memudahkan wisatawan mencari buah tangan.
- **Fitur Artikel / Blog**
  Halaman untuk berbagai publikasi tulisan (`user/artikel.blade.php` & `artikel_detail.blade.php`), yang berguna untuk edukasi pengunjung, publikasi sejarah, tips lokal, serta meningkatkan SEO (_Search Engine Optimization_).
- **Fitur Kategori**
  Sistem penyaring (_filter_) yang mempercepat navigasi tanpa harus menelusuri panjang keseluruhan destinasi. Wisatawan dengan cepat bisa menemukan jenis rekreasi yang dituju (alam, pantai, budaya).

### 6. Rekomendasi Langkah Selanjutnya

1. **Aktifkan RLS dan Terapkan Security Policies:** Mengingat frontend berinteraksi melontar _query_ dan mutasi langsung via Supabase SDK (CSR), pembatasan akses data (_Row Level Security_) wajib **segera diaktifkan**. Atur _Roles_ di Supabase agar _anon_key_ hanya diizinkan mode _SELECT (Read)_ pada _destinations_, _products_, dll., sedangkan akses _UPDATE/INSERT/DELETE_ membutuhkan sesi pengguna autentikasi (_authenticated_ admin).
2. **Sinkronisasi Migrasi Lokal & Live:** Lakukan _pull_ atau introspeksi skema database dari Supabase yang aktif (melalui `supabase db pull` jika memakai CLI, atau dump SQL manual) ke dalam sistem _migration_ Laravel agar arsitektur tertata, terpusat, dan rekam jejak tabel (_schema history_) aman dalam Git.
3. **Pematangan Alur CRUD Terintegrasi:** Berhubung menggunakan DOM JavaScript pada `admin.dashboard`, fokuskan pengkabelan validasi pada JavaScript saat mengunggah foto ke _Bucket_ dan memastikan tautannya (_public url_) terkembalikan masuk ke tabel relasional yang tepat sebelum status disimpan.
4. **Environment Deployment:** Pastikan pengaturan _driver_ untuk sesi dan _cache_ sudah disesuaikan agar cocok untuk _serverless functions_ Vercel.

### 7. Improvement Selanjutnya (Fase Kedepan)

- **Profil & Riwayat Pengguna (_User Dashboard & Wishlist_):** Penambahan dasbor interaktif khusus wisatawan. Pengguna dapat menyimpan destinasi favorit (_wishlist_) serta melihat kilas balik rekam jejak ulasan (_review_) yang telah mereka berikan di platform.
