# Website Yayasan Ekologi Sahul Lestari (YESL)

Aplikasi web profil **Yayasan Ekologi Sahul Lestari (YESL)** — organisasi nirlaba di Tanah Papua yang bergerak dalam pelestarian ekologi, konservasi keanekaragaman hayati, dan penguatan hak masyarakat adat.

Dibangun dengan **Laravel 12** sebagai CMS ringan: beranda *one‑page* statis yang mengonsumsi API, manajemen konten Blog & Album/Galeri, autentikasi peran (admin/operator), tema hijau daun (terang) + mode gelap, dan optimasi SEO.

## Fitur Utama

### Publik
- **Beranda one‑page statis** (hero, tentang, visi & misi, nilai organisasi, donasi, CTA) yang dipindah ke Blade; section **Blog, Kategori, dan Galeri dimuat dinamis via API + Alpine.js**.
- **Blog & Artikel**: daftar + halaman detail, satu artikel bisa memiliki **banyak kategori** (many‑to‑many).
- **Album/Galeri**: daftar + halaman detail dengan **lightbox** foto.
- **Pencarian & filter** pada Blog dan Galeri: kata kunci, **filter A–Z**, **rentang tanggal publikasi**, dan **filter kategori**.
- **Halaman detail ber‑SEO optimal**: meta unik, canonical, Open Graph & Twitter Card, dan **JSON‑LD** (Article / ImageGallery / BreadcrumbList).
- **Halaman statis** (Blade): Kebijakan Privasi, FAQ (dengan akordeon), Peta Situs.
- **`sitemap.xml`** & **`robots.txt`** dinamis.
- **Tema terang (hijau daun) + mode gelap** dengan toggle (disimpan di `localStorage`).
- **Responsif** — seluruh fitur tetap tampil dan dapat diakses di perangkat mobile.

### Panel Admin (`/dashboard`)
- **Autentikasi** admin & operator (login/logout, tanpa registrasi publik).
- **Manajemen peran**: admin mengelola akun **operator** (buat, ubah, reset kata sandi, hapus).
- **Operator** mengelola konten Blog & Album/Galeri; **admin** memiliki akses penuh.
- **CRUD Blog** dengan editor **TinyMCE** (gratis, self‑hosted, mendukung unggah gambar), pemilihan multi‑kategori, sampul, status (draf/terbit), jadwal publikasi, dan kolom SEO.
- **CRUD Kategori** dan **CRUD Album** (termasuk unggah banyak foto + hapus foto).
- **Profil**: ubah data akun & kata sandi sendiri.
- Ringkasan statistik konten di dashboard.

### Performa
- Aset di‑*bundle* & diminifikasi oleh **Vite** (Tailwind melakukan *purge* kelas tak terpakai).
- *Lazy‑loading* gambar, *eager‑loading* relasi (menghindari N+1), paginasi, dan indeks database.
- Font dengan `preconnect`; siap untuk cache konfigurasi/route/view di produksi.

## Teknologi

- **Backend**: PHP 8.2, Laravel 12
- **Database**: SQLite (mudah dipindah ke MySQL/PostgreSQL)
- **Frontend**: Blade, Tailwind CSS 4 (via `@tailwindcss/vite`), Alpine.js 3
- **Build tool**: Vite 7
- **Editor konten**: TinyMCE 8 (self‑hosted, tanpa API key)
- **Ikon & font**: Font Awesome 6, Google Fonts (Plus Jakarta Sans)
- **Autentikasi**: session bawaan Laravel + middleware peran kustom (`role:admin`)

## Persyaratan

- PHP >= 8.2 dengan ekstensi umum Laravel (mbstring, openssl, pdo_sqlite, dll.)
- Composer 2.x
- Node.js 18+ dan npm

## Instalasi

```bash
# 1. Dependensi PHP
composer install

# 2. Dependensi Node (skrip postinstall otomatis menyalin TinyMCE ke public/tinymce)
npm install

# 3. Konfigurasi environment
cp .env.example .env
php artisan key:generate

# 4. Database SQLite + data contoh
php artisan migrate:fresh --seed

# 5. Symlink storage (untuk gambar yang diunggah)
php artisan storage:link

# 6. Build aset
npm run build
```

## Menjalankan (Development)

```bash
# Terminal 1 — Vite (hot reload)
npm run dev

# Terminal 2 — server aplikasi
php artisan serve
```

Buka `http://127.0.0.1:8000`. Dashboard: `/dashboard` · Login: `/login`.

## Akun Default

Dibuat oleh seeder — **segera ganti kata sandi setelah login pertama**.

- **Admin** — email: `admin@yesl.or.id` · kata sandi: `password`
- **Operator** — email: `operator@yesl.or.id` · kata sandi: `password`

## Peta Rute Utama

- Publik: `/`, `/blog`, `/blog/{slug}`, `/galeri`, `/galeri/{slug}`, `/kebijakan-privasi`, `/faq`, `/peta-situs`, `/sitemap.xml`, `/robots.txt`
- API (JSON): `/api/posts`, `/api/categories`, `/api/albums` (mendukung parameter `q`, `category`, `sort`, `from`, `to`, `per_page`)
- Dashboard (perlu login): `/dashboard`, `/dashboard/posts`, `/dashboard/categories`, `/dashboard/albums`, `/dashboard/users` (khusus admin), `/dashboard/profile`

## Model Data

- `users` (+ kolom `role`: `admin` | `operator`)
- `categories`
- `posts` ⇄ `categories` (pivot `category_post`)
- `albums` ⇄ `categories` (pivot `album_category`) ; `albums` → `photos`

## Struktur Penting

- `resources/views/` — layout, beranda, blog, galeri, halaman statis, dan dashboard
- `resources/css/app.css` — tema Tailwind (skala warna hijau daun + varian dark)
- `app/Http/Controllers/` — controller publik, `Api/`, dan `Dashboard/`
- `bin/copy-tinymce.mjs` — menyalin TinyMCE ke `public/tinymce`
- `_template/` — cadangan template statis asli (referensi desain)

## Catatan Produksi

- Atur `APP_URL`, `APP_ENV=production`, `APP_DEBUG=false` di `.env`.
- Jalankan `npm run build` lalu:
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```
- Versi Laravel 12 dipilih karena kompatibel dengan PHP 8.2. Untuk Laravel 13, perlu PHP 8.3+.

## Author

- **Nokensoft.com**
- PIC: 082199558191 (Janzen)

Powered by [Nokensoft.com](https://nokensoft.com)
