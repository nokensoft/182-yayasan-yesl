<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun default (ganti kata sandi setelah login pertama).
        $admin = User::updateOrCreate(
            ['email' => 'admin@yesl.or.id'],
            ['name' => 'Administrator YESL', 'password' => 'password', 'role' => User::ROLE_ADMIN],
        );

        $operator = User::updateOrCreate(
            ['email' => 'operator@yesl.or.id'],
            ['name' => 'Operator Konten', 'password' => 'password', 'role' => User::ROLE_OPERATOR],
        );

        // Kategori
        $categoryNames = [
            'Pemberdayaan', 'Masyarakat Adat', 'Riset & Kajian', 'Biodiversitas',
            'Ekonomi Lokal', 'Pendanaan', 'Inovasi',
        ];
        $categories = collect($categoryNames)->mapWithKeys(fn ($name) => [
            $name => Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => 'Konten seputar '.$name.' di lingkup kerja YESL.'],
            ),
        ]);

        $body = function (string $lead): string {
            return "<p>{$lead}</p>"
                .'<h2>Latar Belakang</h2>'
                .'<p>Yayasan Ekologi Sahul Lestari (YESL) terus mendorong penguatan kapasitas masyarakat adat dalam pengelolaan sumber daya alam yang adil dan berkelanjutan di Tanah Papua.</p>'
                .'<h2>Kegiatan di Lapangan</h2>'
                .'<p>Melalui pendekatan partisipatif, kegiatan ini melibatkan komunitas secara langsung agar hasilnya kontekstual dan berkelanjutan.</p>'
                .'<ul><li>Penguatan kelembagaan adat</li><li>Pemetaan wilayah kelola</li><li>Dokumentasi kearifan lokal</li></ul>'
                .'<p>Kami berkomitmen menjaga transparansi dan melaporkan capaian program secara berkala kepada publik dan mitra.</p>';
        };

        // Artikel blog
        $posts = [
            [
                'title' => 'Meningkatkan Kapasitas Kader Adat dalam Pengelolaan Wilayah Kelola',
                'excerpt' => 'Bagaimana kelompok masyarakat adat mengoptimalkan ruang darat dan perairan berbasis kearifan lokal yang berkelanjutan.',
                'cover' => 'images/gallery/galeri1.png',
                'date' => '2026-07-01 09:00',
                'views' => 142,
                'cats' => ['Pemberdayaan', 'Masyarakat Adat'],
            ],
            [
                'title' => 'Pentingnya Pendokumentasian Hukum Adat dan Keanekaragaman Hayati',
                'excerpt' => 'Menelisik proses penyusunan profil wilayah adat sebagai basis advokasi dan pelindungan hak-hak masyarakat lokal.',
                'cover' => 'images/gallery/galeri2.png',
                'date' => '2026-06-25 10:30',
                'views' => 98,
                'cats' => ['Riset & Kajian', 'Biodiversitas'],
            ],
            [
                'title' => 'Transformasi Ekonomi Hijau Melalui Penguatan Lembaga Adat',
                'excerpt' => 'Kolaborasi multipihak dalam mengembangkan potensi komoditas lokal yang adil tanpa merusak kelestarian alam sekitar.',
                'cover' => 'images/gallery/galeri3.png',
                'date' => '2026-06-18 08:15',
                'views' => 215,
                'cats' => ['Ekonomi Lokal'],
            ],
            [
                'title' => 'Mekanisme Pembiayaan Inovatif untuk Konservasi Berbasis Komunitas',
                'excerpt' => 'Menjamin kesinambungan program perlindungan hak adat lewat skema pendanaan yang inklusif dan transparan.',
                'cover' => 'images/gallery/galeri4.png',
                'date' => '2026-06-10 13:45',
                'views' => 310,
                'cats' => ['Pendanaan', 'Inovasi'],
            ],
        ];

        foreach ($posts as $data) {
            $post = Post::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'user_id' => $operator->id,
                    'title' => $data['title'],
                    'excerpt' => $data['excerpt'],
                    'body' => $body($data['excerpt']),
                    'cover_image' => $data['cover'],
                    'status' => 'published',
                    'published_at' => Carbon::parse($data['date']),
                    'views' => $data['views'],
                    'meta_description' => $data['excerpt'],
                ],
            );
            $post->categories()->sync(collect($data['cats'])->map(fn ($c) => $categories[$c]->id)->all());
        }

        // Kolam foto contoh
        $photoPool = [
            'images/gallery/galeri1.png', 'images/gallery/galeri2.png', 'images/gallery/galeri3.png',
            'images/gallery/galeri4.png', 'images/gallery/galeri5.png', 'images/gallery/tentang1.jpeg',
            'images/gallery/tentang1.png', 'images/gallery/tentang2.png',
        ];

        // Album galeri
        $albums = [
            ['title' => 'Pemetaan Partisipatif Wilayah Tangkap Suku Kamoro', 'cover' => 'images/gallery/galeri1.png', 'date' => '2026-06-28 09:00', 'views' => 142, 'cats' => ['Masyarakat Adat', 'Riset & Kajian']],
            ['title' => 'Pengembangan Pemandu Lokal Ekowisata Mangrove Pomako', 'cover' => 'images/gallery/galeri2.png', 'date' => '2026-06-20 09:00', 'views' => 98, 'cats' => ['Ekonomi Lokal', 'Pemberdayaan']],
            ['title' => 'Kajian EKOSOBLING & Profil Masyarakat Hukum Adat', 'cover' => 'images/gallery/galeri3.png', 'date' => '2026-06-12 09:00', 'views' => 215, 'cats' => ['Riset & Kajian']],
            ['title' => 'Perhutanan Sosial Perempuan & Generasi Muda Papua', 'cover' => 'images/gallery/galeri4.png', 'date' => '2026-06-05 09:00', 'views' => 310, 'cats' => ['Pemberdayaan', 'Biodiversitas']],
            ['title' => 'Pengelolaan Hutan Desa Yefu, Wagi, dan Sagare', 'cover' => 'images/gallery/galeri5.png', 'date' => '2026-05-30 09:00', 'views' => 187, 'cats' => ['Masyarakat Adat', 'Ekonomi Lokal']],
        ];

        foreach ($albums as $data) {
            $album = Album::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'user_id' => $operator->id,
                    'title' => $data['title'],
                    'description' => 'Dokumentasi kegiatan '.$data['title'].' oleh Yayasan Ekologi Sahul Lestari.',
                    'cover_image' => $data['cover'],
                    'status' => 'published',
                    'published_at' => Carbon::parse($data['date']),
                    'views' => $data['views'],
                    'meta_description' => 'Album foto: '.$data['title'].'.',
                ],
            );
            $album->categories()->sync(collect($data['cats'])->map(fn ($c) => $categories[$c]->id)->all());

            if ($album->photos()->count() === 0) {
                $selection = collect($photoPool)->shuffle()->take(5)->values();
                foreach ($selection as $order => $path) {
                    $album->photos()->create(['image_path' => $path, 'sort_order' => $order + 1]);
                }
            }
        }
    }
}
