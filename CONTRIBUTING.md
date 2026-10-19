# Panduan Kontribusi - SIGAP Notulensi (BRIDA)

Dokumen ini berisi aturan dan pembagian kerja untuk tim pengembang agar kolaborasi tetap rapi dan tidak saling bentrok

---

## Pembagian Tim & Tanggung Jawab

### Frontend
* **Frontend 1:**
  * Halaman Utama/ Dashboard (Tabel Arsip & Riwayat Rapat)
  * Fitur Pencarian (Search) & Filter Tabel
  * *Layout* utama (`app.blade.php`, Navbar, Sidebar)
* **Frontend 2:**
  * Halaman Detail Rapat (Box Ringkasan Pembahasan, Durasi, Detail Peserta).
  * Halaman Form Input / Edit Notulensi.
  * Integrasi komponen interaktif menggunakan **Alpine.js**.

### Tim Backend (Silahkan disesuaikan)
* **Backend 1:**
  * Perancangan Database & Migrasi (Tabel Rapat, Notulensi, User).
  * *Routing* dan *Controller* utama untuk pengelolaan data arsip.
* **Backend 2:**
  * Integrasi fitur unggulan (misal: Ekspor PDF / Integrasi Speech-to-Text / LLM).
  * Autentikasi (Login/Logout) dan keamanan sistem (*middleware*).

---

## Aturan Git & Branching
Agar kode tidak konflik, ikuti aturan penamaan *branch* berikut sebelum *push* ke GitHub:
1. `feature/frontend-[nama-fitur]` (Contoh: `feature/frontend-tabel-arsip`)
2. `feature/backend-[nama-fitur]` (Contoh: `feature/backend-auth-login`)
3. Dilarang langsung melakukan *push* ke *branch* `main` tanpa melalui pengecekan bersama.

---

## Standar Pengerjaan Frontend (Untuk Frontend 1 & 2)
1. **Gunakan Data Statis / Dummy Terlebih Dahulu:** Jika backend masih menyiapkan *database*, silakan buat tampilannya statis di dalam file `.blade.php` menggunakan **Tailwind CSS**.
2. **Konsistensi UI:** Pastikan ukuran, warna, dan jarak padding/margin sesuai dengan desain Figma.
3. **Penyimpanan File:** Semua file tampilan wajib ditaruh di dalam folder `resources/views/`.

---

## 🚀 Cara Menjalankan Proyek di Lokal
untuk anggota tim yang baru pull repositori ini, jalankan perintah berikut di terminal:
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan dev