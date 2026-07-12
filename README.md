# Website Yayasan Ekologi Sahul Lestari (YESL)

Aplikasi web profil **Yayasan Ekologi Sahul Lestari (YESL)** — organisasi nirlaba di Tanah Papua yang bergerak dalam pelestarian ekologi, konservasi keanekaragaman hayati, dan penguatan hak masyarakat adat.

Dibangun dengan **Laravel 12** sebagai CMS ringan: beranda *one‑page* statis yang mengonsumsi API, manajemen konten Blog & Album/Galeri, autentikasi peran (admin/operator), tema hijau daun (terang) + mode gelap, dan optimasi SEO.

## Fitur Utama

### Publik
- **Beranda one‑page** (perpaduan konten statis Blade + dinamis) dengan section berurutan: hero, **statistik dampak**, blog, tentang (arti nama & **filosofi logo**), **visi & misi**, nilai organisasi, **program prioritas (4 pilar)**, galeri, **mengapa YESL**, **tim**, donasi, **mitra kerja**, dan CTA. Section **Blog, Kategori, dan Galeri dimuat dinamis via API + Alpine.js**.
- **Statistik dampak** ringkas hingga 2024 (wilayah dampingan, penerima manfaat, komunitas adat, donor strategis, tahun pengalaman).
- **Donasi**: ajakan berkontribusi dengan tombol WhatsApp dan panel **informasi rekening** (salin nomor rekening sekali klik).
- **Profil tim**: pembina, pengawas, dan staf beserta perannya.
- **Mitra kerja**: galeri **logo mitra & donor** (BRIN, EcoNusa, Pemkab Mimika, Konservasi Indonesia, Packard Foundation, The Asia Foundation, dll.).
- **Blog & Artikel**: daftar + halaman detail, satu artikel bisa memiliki **banyak kategori** (many‑to‑many).
- **Album/Galeri**: daftar + halaman detail dengan **lightbox** foto.
- **Pencarian & filter** pada Blog dan Galeri: kata kunci, **filter A–Z**, **rentang tanggal publikasi**, dan **filter kategori**.
- **Halaman detail ber‑SEO optimal**: meta unik, canonical, Open Graph & Twitter Card, dan **JSON‑LD** (Article / ImageGallery / BreadcrumbList).
- **Halaman statis** (Blade): Kebijakan Privasi, FAQ (dengan akordeon), Peta Situs.
- **`sitemap.xml`** & **`robots.txt`** dinamis.
- **Footer informatif**: alamat kantor, **peta lokasi (Google Maps)**, tautan media sosial (Instagram, Facebook, YouTube, WhatsApp), dan badge terverifikasi **NGO Source**.
- **Widget mengambang**: tombol kembali ke atas + akses cepat media sosial.
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

## Halaman & Section Statis vs Dinamis (CMS)

Situs ini menggabungkan **konten statis** (dikodekan dalam Blade, hanya bisa diubah oleh developer)
dan **konten dinamis** (dikelola melalui dashboard CMS).

### Konten Statis — Hanya bisa diubah dengan coding

Bagian-bagian berikut dikodekan langsung dalam file Blade. Perubahan memerlukan akses ke kode sumber
dan deploy ulang.

| Section / Halaman | File Blade | Keterangan |
|---|---|---|
| **Hero** | `resources/views/home.blade.php` | Judul utama, tagline, deskripsi YESL, teks & tautan 2 tombol CTA. Gambar slider di `components/hero.blade.php` |
| **Statistik Dampak** | `resources/views/partials/dampak.blade.php` | 5 kotak angka: Wilayah Dampingan (114.941 Ha), Penerima Manfaat (3.843), Komunitas Adat (9), Donor Strategis (5), Tahun Pengalaman (5) |
| **Tentang YESL** | `resources/views/partials/tentang.blade.php` | Logo, 4 paragraf profil organisasi, akordeon Arti Nama, Filosofi Logo, dan tabel Status Legalitas (NIB, SIUP, akta notaris, KEMENKUMHAM, NPWP, alamat, kontak) |
| **Visi & Misi** | `resources/views/partials/visi-misi.blade.php` | Teks visi, 5 poin misi, wilayah kerja & kedudukan |
| **Nilai Organisasi** | `resources/views/partials/nilai.blade.php` | 5 nilai inti beserta deskripsi |
| **Program Prioritas** | `resources/views/partials/program.blade.php` | 4 pilar (Kajian & Pengetahuan, Transformasi Ekonomi, Pemberdayaan Masyarakat, Pembiayaan Inovatif). Gambar di `public/images/proram-prioritas/` |
| **Mengapa YESL** | `resources/views/partials/mengapa.blade.php` | 5 alasan. Foto di `public/images/mengapa-yesl/` |
| **Tim YESL** | `resources/views/partials/tim.blade.php` | Nama, jabatan, dan foto tim (Pembina, Pengawas, Staf). Foto di `public/images/team/` |
| **Donasi / Berkontribusi** | `resources/views/partials/mari-berkontribusi.blade.php` | Nomor WA (`62811490000`), rekening BRI a.n. EKOLOGI SAHUL LESTARI No. `056101002563303` Cabang Timika |
| **Mitra Kerja** | `resources/views/partials/mitra-kerja.blade.php` | 7 logo mitra (BRIN, EcoNusa, Pemkab Mimika, dll.). Logo di `public/images/patners/` |
| **CTA** | `resources/views/partials/cta.blade.php` | Banner ajakan kolaborasi di akhir beranda |
| **Navigasi** | `resources/views/partials/nav.blade.php` | Menu header, logo, toggle dark-mode |
| **Footer** | `resources/views/partials/footer.blade.php` | Alamat kantor, peta Google Maps, media sosial, badge NGO Source |
| **Kebijakan Privasi** | `resources/views/pages/privacy.blade.php` | URL: `/kebijakan-privasi` |
| **FAQ** | `resources/views/pages/faq.blade.php` | URL: `/faq` |
| **Program Berjalan** | `resources/views/pages/program-berjalan.blade.php` | URL: `/program-berjalan` |
| **Peta Situs** | `resources/views/pages/sitemap.blade.php` | URL: `/peta-situs` |

### Konten Dinamis — Dikelola lewat Dashboard CMS (`/dashboard`)

| Modul | URL Dashboard | Tampil di |
|---|---|---|
| **Blog / Artikel** | `/dashboard/posts` | `/blog`, `/blog/{slug}`, section Blog beranda |
| **Kategori** | `/dashboard/categories` | Filter blog & galeri |
| **Album & Galeri** | `/dashboard/albums` | `/galeri`, `/galeri/{slug}`, section Galeri beranda |
| **Pengguna** *(admin only)* | `/dashboard/users` | — |

> **Catatan:** Section Blog dan Galeri di beranda memuat data secara dinamis via API + Alpine.js
> (`/api/posts`, `/api/albums`, `/api/categories`). Teks header section-nya tetap statis di file Blade.

## Struktur Penting

- `resources/views/` — layout, beranda, blog, galeri, halaman statis, dan dashboard
- `resources/views/partials/` — section-section beranda statis (hero, dampak, tentang, dll.)
- `resources/views/pages/` — halaman statis tambahan (FAQ, privasi, program, peta situs)
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
