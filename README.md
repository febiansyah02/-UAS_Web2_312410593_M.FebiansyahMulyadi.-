# E-LIBRARY UPB — Sistem Informasi Perpustakaan Digital Berbasis Web Modern (Full-Stack Decoupled Architecture)

## Deskripsi Tema Studi Kasus
Proyek ini adalah sebuah aplikasi perpustakaan digital interaktif yang dirancang untuk mendigitalisasi proses pencatatan sirkulasi buku di lingkungan kampus Universitas Pelita Bangsa. Aplikasi ini menggunakan pendekatan arsitektur Decoupled Web, yang memisahkan antara Backend API RESTful (CodeIgniter 4) sebagai pusat pengelolaan basis data MySQL, dan Frontend SPA (Vue.js 3 + Tailwind CSS) sebagai antarmuka pengguna yang responsif.

Untuk menyelesaikan masalah tersebut, sistem ini dirancang dengan memisahkan fungsi operasional menjadi dua aktor utama:
1. **Sisi Mahasiswa/Pengunjung**: Dapat menjelajahi katalog buku yang terintegrasi secara *live*, melihat status ketersediaan ekslempar secara visual, dan melakukan simulasi pengajuan peminjaman dokumen secara mandiri melalui antarmuka yang ramah pengguna.
2. **Sisi Administrator (Pustakawan)**: Memiliki hak akses khusus untuk melakukan manajemen data koleksi (*Create, Read, Update, Delete*) serta memantau log riwayat transaksi aktif mahasiswa secara terpusat untuk meminimalisir risiko kehilangan dokumen.

Pengembangan aplikasi ini menerapkan arsitektur *Decoupled Web Application* (Pemisahan Frontend & Backend) guna menjamin performa aplikasi yang cepat, aman, dan mudah dikembangkan di masa mendatang.

---

## Identitas Pengembang
* **Nama** : M. Febiansyah Mulyadi
* **NIM** : 312410593
* **Program Studi** : Teknik Informatika
* **Kampus** : Universitas Pelita Bangsa
* **Tahun Akademik**: 2026

---

## Teknologi yang Digunakan

### Frontend (Client Side)
* **Framework** : Vue.js 3 (Vite Engine)
* **Styling** : Tailwind CSS v3 (Premium Glassmorphic & Modern Grid Card)
* **Icons** : FontAwesome v6 (Solid & Regular)
* **State/Logic**: Vue Composition & Options API (Fetch Asynchronous)

### Backend (Server Side)
* **Framework** : CodeIgniter 4.x (RESTful Resource Controller)
* **Language** : PHP 8.x
* **Database** : MySQL / MariaDB via XAMPP
* **Format Data**: JSON (JavaScript Object Notation)

## Struktur Direktori Proyek

```text
📁 UAS_Web2_312410593_M.FebiansyahMulyadi/
│
├── 📁 backend-api/          <-- Source Code CodeIgniter 4
│   ├── 📁 app/
│   │   ├── 📁 Controllers/  <-- Auth.php & Buku.php (API Logic)
│   │   ├── 📁 Filters/      <-- Cors.php (Bypass Port Origin)
│   │   └── 📁 Models/       <-- BukuModel.php (Query Relasi Database)
│   └── 📁 public/           <-- index.php (Garis Depan Server Endpoint)
│
└── 📁 frontend-vue/         <-- Source Code Vue.js 3
    ├── 📁 src/
    │   ├── 📄 App.vue       <-- Core UI Dashboard & Fetch JavaScript Logic
    │   └── 📄 main.js       <-- Inisialisasi Aplikasi & Tailwind Import
    ├── 📄 package.json      <-- Dependensi Framework & Script Running
    └── 📄 vite.config.js    <-- Konfigurasi Port Server Localhost (:5173)
```
---


## 1. Skema Relasi Tabel Database
Berikut adalah rancangan arsitektur basis data MySQL (`uas_elibrary`) yang mengatur relasi antara data buku, kategori/genre, dan akun pengguna (users).

> ⚠️ *PANDUAN PEMASANGAN: Jika menu Desainer phpMyAdmin kamu blank, silakan ambil screenshot dari halaman **Tampilan Hubungan (Relation View)** pada struktur tabel `buku` kamu, lalu simpan gambarnya di folder project dengan nama `skema_database.png`.*

![Skema Relasi Database phpMyAdmin](skema_database.png)

---

##  2. Screenshot Uji Coba Proteksi API (Error 401 - Unauthorized)
Untuk menjamin keamanan sistem, endpoint manipulasi data pada backend CodeIgniter 4 telah diproteksi menggunakan token autentikasi. Berikut adalah bukti pengujian gagal via **Postman** saat mencoba menembak API tanpa menyertakan token valid:

> ⚠️ *PANDUAN PEMASANGAN: Buka Postman, coba lakukan POST/PUT/DELETE ke URL API Buku kamu tanpa memasukkan token. Saat muncul status `401 Unauthorized` atau pesan error login, screenshot dan simpan dengan nama `error_401_postman.png`.*

![Uji Coba Tembak API Gagal - Error 401](error_401_postman.png)

---

## 3. Dokumentasi Antarmuka Aplikasi (UI Showcase)

Bagian ini menampilkan keunggulan visualisasi antarmuka (User Interface) aplikasi E-Library UPB yang responsif dan modern menggunakan TailwindCSS:

### A. Tampilan Halaman Utama & Formulir Peminjaman Mahasiswa
Tampilan awal direktori buku dalam bentuk grid card modern. Dilengkapi fitur pop-up form peminjaman interaktif untuk mahasiswa (wajib input Nama, NIM, dan Durasi).
<img width="959" height="539" alt="image" src="https://github.com/user-attachments/assets/b35e2c6d-c573-41e0-b49b-edfb3dcc525e" />
<img width="959" height="539" alt="image" src="https://github.com/user-attachments/assets/83a77cdb-2bd3-4ad5-95e6-5835c750e937" />

### B. Tampilan Halaman Login Administrator
Formulir popup modal estetik berlatar belakang glassmorphism untuk memverifikasi hak akses akun pengelola.
<img width="959" height="539" alt="image" src="https://github.com/user-attachments/assets/bba15f46-67bb-49a2-bb9e-1d1ade08b039" />

### C. Tampilan Halaman Dashboard Admin & Log Riwayat Pinjam
Tampilan internal admin yang membuka fitur rahasia "Tambah Buku Baru", tombol aksi manajemen berkas, serta tabel sirkulasi riwayat peminjaman mahasiswa secara live.
<img width="959" height="539" alt="image" src="https://github.com/user-attachments/assets/03e36695-a520-4050-aab8-a57173d3ccba" />
<img width="959" height="539" alt="image" src="https://github.com/user-attachments/assets/3be4a74c-2690-471b-9f3c-3072da56e4cc" />

### D. Tampilan Form Modal Tambah / Edit Data Buku
Antarmuka formulir dinamis yang dilengkapi komponen *Dropdown Selection* kategori bawaan (Komik, Novel, Sains) untuk mempermudah entri data ke database.
<img width="959" height="539" alt="image" src="https://github.com/user-attachments/assets/ee8647b4-4e3e-4cd2-9a75-9d39b5739f8a" />
<img width="959" height="539" alt="image" src="https://github.com/user-attachments/assets/a326039e-edf6-455d-b50a-3e20f6d9ca93" />

---

## 4. Petunjuk Instalasi & Cara Menjalankan Proyek

### A. Persiapan Sistem Backend (CodeIgniter 4)
1. Aktifkan modul **Apache** dan **MySQL** pada control panel XAMPP.
2. Pindahkan folder `backend-api` ke dalam direktori `C:/xampp/htdocs/`.
3. Buka browser dan masuk ke `http://localhost/phpmyadmin/`.
4. Buat database baru bernama **`uas_elibrary`**, lalu import file database proyek kamu di sana.

### B. Persiapan Sistem Frontend (Vue 3 + TailwindCSS)
1. Buka folder `frontend-vue` menggunakan VS Code Terminal atau Command Prompt.
2. Jalankan perintah berikut untuk mengunduh modul dependensi node:
```bash
   npm install
```
3. Jalankan server lokal Vue dengan perintah:
```
   npm run dev
```
4. Buka tautan output di browser: http://localhost:5173/.
