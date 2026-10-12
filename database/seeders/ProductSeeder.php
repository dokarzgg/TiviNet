<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * 10 paket WiFi contoh. Harga di bawah hanyalah CONTOH —
     * ganti dengan harga resmi sebelum website dipublikasikan.
     * Setelah mengubah file ini jalankan: php artisan migrate:fresh --seed
     */
    public function run(): void
    {
        $common = ['Instalasi cepat oleh teknisi', 'Kuota tanpa batas (unlimited)', 'Router WiFi disediakan', 'Bantuan pelanggan via WhatsApp'];

        $products = [
            [
                'name' => 'Tivi Lite', 'speed' => 10, 'price' => 150000, 'category' => 'rumahan', 'featured' => true,
                'devices' => '1–3 perangkat',
                'summary' => 'Paket hemat untuk browsing, chat, dan media sosial.',
                'description' => 'Pilihan paling terjangkau untuk penghuni kos atau keluarga kecil yang membutuhkan internet harian untuk chatting, media sosial, dan menonton video dengan kualitas standar.',
                'features' => ['Cocok untuk 1–3 perangkat', 'Nyaman untuk browsing & chat', 'Streaming video kualitas SD–HD'],
            ],
            [
                'name' => 'Tivi Basic', 'speed' => 20, 'price' => 185000, 'category' => 'rumahan', 'featured' => false,
                'devices' => '3–5 perangkat',
                'summary' => 'Kecepatan seimbang untuk kebutuhan keluarga kecil.',
                'description' => 'Paket dengan kecepatan seimbang untuk keluarga kecil: belajar online, bekerja dari rumah ringan, serta hiburan streaming di beberapa perangkat sekaligus.',
                'features' => ['Cocok untuk 3–5 perangkat', 'Mendukung belajar online', 'Streaming video HD lancar'],
            ],
            [
                'name' => 'Tivi Home', 'speed' => 30, 'price' => 225000, 'category' => 'rumahan', 'featured' => true,
                'devices' => '4–6 perangkat',
                'summary' => 'Pilihan nyaman untuk rumah dengan banyak pengguna.',
                'description' => 'Cocok untuk rumah dengan beberapa pengguna aktif. Video call, unduh berkas, dan streaming dapat berjalan bersamaan tanpa saling mengganggu.',
                'features' => ['Cocok untuk 4–6 perangkat', 'Video call lancar', 'Streaming HD di beberapa layar'],
            ],
            [
                'name' => 'Tivi Plus', 'speed' => 50, 'price' => 275000, 'category' => 'rumahan', 'featured' => true,
                'devices' => '5–8 perangkat', 'popular' => true,
                'summary' => 'Paket terlaris untuk keluarga dan pekerja dari rumah.',
                'description' => 'Paket favorit pelanggan kami. Kecepatan yang lega untuk bekerja dari rumah, sekolah daring, dan hiburan keluarga secara bersamaan.',
                'features' => ['Cocok untuk 5–8 perangkat', 'Ideal untuk WFH & sekolah daring', 'Streaming Full HD stabil'],
            ],
            [
                'name' => 'Tivi Family', 'speed' => 75, 'price' => 335000, 'category' => 'rumahan', 'featured' => false,
                'devices' => '8–10 perangkat',
                'summary' => 'Internet lega untuk keluarga besar dan banyak perangkat.',
                'description' => 'Dirancang untuk keluarga besar dengan banyak perangkat pintar, TV streaming, dan kebutuhan unduh yang tinggi.',
                'features' => ['Cocok untuk 8–10 perangkat', 'Mendukung perangkat smart home', 'Streaming 4K di satu layar'],
            ],
            [
                'name' => 'Tivi Stream', 'speed' => 100, 'price' => 399000, 'category' => 'streaming-gaming', 'featured' => true,
                'devices' => '10–12 perangkat',
                'summary' => 'Streaming 4K dan unduhan besar tanpa buffering.',
                'description' => 'Untuk pecinta film dan konten digital. Nikmati streaming resolusi tinggi di beberapa layar dan unduh berkas besar dalam waktu singkat.',
                'features' => ['Cocok untuk 10–12 perangkat', 'Streaming 4K lancar', 'Unduh berkas besar lebih cepat'],
            ],
            [
                'name' => 'Tivi Gamer', 'speed' => 150, 'price' => 499000, 'category' => 'streaming-gaming', 'featured' => false,
                'devices' => '12–15 perangkat',
                'summary' => 'Koneksi responsif untuk game online dan live streaming.',
                'description' => 'Koneksi stabil dengan respons cepat untuk gamer dan kreator konten yang melakukan live streaming serta unggah video berukuran besar.',
                'features' => ['Cocok untuk 12–15 perangkat', 'Stabil untuk game online', 'Nyaman untuk live streaming'],
            ],
            [
                'name' => 'Tivi Pro', 'speed' => 200, 'price' => 599000, 'category' => 'bisnis', 'featured' => true,
                'devices' => '15–20 perangkat',
                'summary' => 'Untuk usaha kecil, kafe, dan kantor dengan banyak pengguna.',
                'description' => 'Solusi untuk UMKM, kafe, dan kantor kecil yang membutuhkan koneksi andal bagi karyawan dan pelanggan.',
                'features' => ['Cocok untuk 15–20 perangkat', 'Andal untuk kafe & kantor kecil', 'Mendukung kasir & CCTV online'],
            ],
            [
                'name' => 'Tivi Business', 'speed' => 300, 'price' => 849000, 'category' => 'bisnis', 'featured' => false,
                'devices' => '20–30 perangkat',
                'summary' => 'Kapasitas besar untuk kantor, toko, dan tempat usaha.',
                'description' => 'Kapasitas besar untuk tempat usaha yang ramai: rapat daring, pencadangan data ke cloud, dan operasional harian tanpa hambatan.',
                'features' => ['Cocok untuk 20–30 perangkat', 'Rapat daring berkualitas', 'Backup data cloud lebih cepat'],
            ],
            [
                'name' => 'Tivi Ultra', 'speed' => 500, 'price' => 1299000, 'category' => 'bisnis', 'featured' => false,
                'devices' => '30+ perangkat',
                'summary' => 'Performa tertinggi untuk bisnis dengan kebutuhan besar.',
                'description' => 'Paket tertinggi kami untuk perusahaan dan tempat usaha dengan lalu lintas data besar serta banyak pengguna aktif sekaligus.',
                'features' => ['Cocok untuk 30+ perangkat', 'Performa tinggi untuk operasional besar', 'Prioritas penanganan pelanggan'],
            ],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(
                ['slug' => Str::slug($p['name'] . ' ' . $p['speed'] . ' mbps')],
                [
                    'name'        => $p['name'],
                    'category'    => $p['category'],
                    'speed_mbps'  => $p['speed'],
                    'price'       => $p['price'],
                    'summary'     => $p['summary'],
                    'description' => $p['description'],
                    'features'    => array_merge($p['features'], array_slice($common, 0, 2)),
                    'icon'        => 'bi-wifi',
                    'is_featured' => $p['featured'],
                    'is_popular'  => $p['popular'] ?? false,
                ]
            );
        }
    }
}
