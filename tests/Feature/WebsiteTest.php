<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\InstallationRequest;
use App\Models\Product;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(ProductSeeder::class);
    }

    public function test_ada_10_produk(): void
    {
        $this->assertSame(10, Product::count());
    }

    public function test_beranda_menampilkan_5_paket_dan_tombol_lihat_produk(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Tivi Internet')
            ->assertSee('Lihat Produk')
            ->assertSee('Pasang WiFi Baru')
            ->assertSee('wa.me/62822748399', false);

        $this->assertSame(5, Product::where('is_featured', true)->count());
    }

    public function test_halaman_tentang_tampil(): void
    {
        $this->get('/tentang')
            ->assertOk()
            ->assertSee('Visi')
            ->assertSee('maps.google.com', false);
    }

    public function test_produk_dibagi_2_halaman_masing_masing_5(): void
    {
        // Dropdown formulir memuat semua paket, jadi periksa kartu/popup detail yang tampil, bukan seluruh teks halaman.
        $page1 = $this->get('/produk')->assertOk();
        $names1 = $page1->viewData('products')->pluck('name')->all();
        $this->assertSame(['Tivi Lite', 'Tivi Basic', 'Tivi Home', 'Tivi Plus', 'Tivi Family'], $names1);
        $page1->assertSee('id="detail-' . Product::where('name', 'Tivi Lite')->value('id') . '"', false)
              ->assertDontSee('id="detail-' . Product::where('name', 'Tivi Ultra')->value('id') . '"', false);

        $page2 = $this->get('/produk?page=2')->assertOk();
        $names2 = $page2->viewData('products')->pluck('name')->all();
        $this->assertSame(['Tivi Stream', 'Tivi Gamer', 'Tivi Pro', 'Tivi Business', 'Tivi Ultra'], $names2);
        $page2->assertSee('id="detail-' . Product::where('name', 'Tivi Ultra')->value('id') . '"', false)
              ->assertDontSee('id="detail-' . Product::where('name', 'Tivi Lite')->value('id') . '"', false);
    }

    public function test_setiap_produk_punya_popup_detail_dan_tombol_pasang(): void
    {
        $product = Product::where('name', 'Tivi Plus')->firstOrFail();

        $this->get('/produk')
            ->assertOk()
            ->assertSee('id="detail-' . $product->id . '"', false)
            ->assertSee('Pasang Sekarang')
            ->assertSee('data-product-id="' . $product->id . '"', false);
    }

    public function test_pendaftaran_pasang_wifi_berhasil(): void
    {
        $product = Product::first();

        $this->post('/pendaftaran', [
            'product_id' => $product->id,
            'name'       => 'Budi Santoso',
            'phone'      => '0812-3456-7890',
            'address'    => 'Jl. Melati No. 5, Pamulang, Tangerang Selatan',
        ])->assertRedirect()->assertSessionHas('install_success');

        $this->assertDatabaseHas('installation_requests', [
            'product_id' => $product->id,
            'name'       => 'Budi Santoso',
            'phone'      => '081234567890',
            'status'     => 'baru',
        ]);
        $this->assertSame(1, InstallationRequest::count());
    }

    public function test_pendaftaran_divalidasi(): void
    {
        $this->from('/produk')
            ->post('/pendaftaran', ['product_id' => 999, 'name' => '', 'phone' => '123', 'address' => 'pendek'])
            ->assertRedirect('/produk')
            ->assertSessionHasErrorsIn('install', ['product_id', 'name', 'phone', 'address']);

        $this->assertSame(0, InstallationRequest::count());
    }

    public function test_formulir_dibuka_kembali_saat_validasi_gagal(): void
    {
        $this->from('/produk')->post('/pendaftaran', ['name' => '']);

        $this->followingRedirects()->get('/produk')->assertSee('data-open-on-load="1"', false);
    }

    public function test_halaman_kontak_dan_kirim_pesan(): void
    {
        $this->get('/kontak')->assertOk()->assertSee('0822748399');

        $this->post('/kontak', [
            'name'    => 'Siti',
            'email'   => 'siti@example.com',
            'subject' => 'Tanya paket',
            'message' => 'Apakah area Pamulang sudah terjangkau?',
        ])->assertRedirect(route('contact'))->assertSessionHas('success');

        $this->assertSame(1, ContactMessage::count());
    }

    public function test_warna_kartu_makin_gelap_saat_mbps_makin_tinggi(): void
    {
        $lum = function (Product $p): float {
            // Kecerahan rata-rata kedua warna gradasi (0 = hitam, 255 = putih).
            preg_match_all('/#([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})/i', $p->card_gradient['style'], $m, PREG_SET_ORDER);
            $sum = 0;
            foreach ($m as $c) {
                $sum += (hexdec($c[1]) + hexdec($c[2]) + hexdec($c[3])) / 3;
            }

            return $sum / count($m);
        };

        $products = Product::orderBy('speed_mbps')->get();
        $values   = $products->map($lum)->all();

        // Makin tinggi Mbps, makin kecil kecerahan (makin gelap).
        for ($i = 1; $i < count($values); $i++) {
            $this->assertLessThan($values[$i - 1], $values[$i], "Paket {$products[$i]->name} harus lebih gelap dari {$products[$i - 1]->name}");
        }

        // Paket tercepat memakai teks putih, paket terlambat memakai teks gelap.
        $this->assertFalse($products->first()->card_gradient['dark']);
        $this->assertTrue($products->last()->card_gradient['dark']);
    }
}
