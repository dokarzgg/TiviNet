<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Kategori paket. Kunci disimpan di database (kolom `category`).
     */
    public const CATEGORIES = [
        'rumahan' => [
            'label' => 'Rumahan',
            'icon'  => 'bi-house-heart',
        ],
        'streaming-gaming' => [
            'label' => 'Streaming & Gaming',
            'icon'  => 'bi-controller',
        ],
        'bisnis' => [
            'label' => 'Bisnis & UMKM',
            'icon'  => 'bi-shop',
        ],
    ];

    protected $fillable = [
        'name',
        'slug',
        'category',
        'speed_mbps',
        'price',
        'summary',
        'description',
        'features',
        'icon',
        'is_featured',
        'is_popular',
    ];

    protected function casts(): array
    {
        return [
            'features'    => 'array',
            'is_featured' => 'boolean',
            'is_popular'  => 'boolean',
        ];
    }

    /** Rentang kecepatan paket (Mbps) untuk menghitung gradasi warna kartu. */
    public const MIN_SPEED = 10;
    public const MAX_SPEED = 500;

    /**
     * Posisi kecepatan paket pada skala 0 (terendah) – 1 (tertinggi).
     * Memakai skala logaritmik supaya 10→20→30→50 terlihat jelas bedanya.
     */
    public function getSpeedLevelAttribute(): float
    {
        $speed = max(self::MIN_SPEED, min(self::MAX_SPEED, $this->speed_mbps));

        return (log($speed) - log(self::MIN_SPEED)) / (log(self::MAX_SPEED) - log(self::MIN_SPEED));
    }

    /**
     * Gradasi biru kartu: makin tinggi Mbps, makin gelap.
     * Hasil: ['style' => 'background-image: ...', 'dark' => true|false (teks putih?)]
     */
    public function getCardGradientAttribute(): array
    {
        $t = $this->speed_level;

        // Tiga titik warna (t = 0, 0,5, 1) supaya tetap biru jenuh, tidak keabu-abuan.
        $from = self::mixStops(['#e3f5fe', '#4aa9de', '#0b5a94'], $t);
        $to   = self::mixStops(['#8fd3f4', '#2f86c4', '#020f1f'], $t);

        return [
            'style' => "background-image: linear-gradient(160deg, {$from} 0%, {$to} 100%);",
            'dark'  => $t >= 0.5, // paket cepat = latar gelap = teks putih
        ];
    }

    /** Campur tiga warna: stop[0] di t=0, stop[1] di t=0,5, stop[2] di t=1. */
    private static function mixStops(array $stops, float $t): string
    {
        return $t < 0.5
            ? self::mixHex($stops[0], $stops[1], $t * 2)
            : self::mixHex($stops[1], $stops[2], ($t - 0.5) * 2);
    }

    private static function mixHex(string $a, string $b, float $t): string
    {
        $ca = sscanf($a, '#%02x%02x%02x');
        $cb = sscanf($b, '#%02x%02x%02x');

        return sprintf('#%02x%02x%02x',
            round($ca[0] + ($cb[0] - $ca[0]) * $t),
            round($ca[1] + ($cb[1] - $ca[1]) * $t),
            round($ca[2] + ($cb[2] - $ca[2]) * $t),
        );
    }

    public function installationRequests()
    {
        return $this->hasMany(InstallationRequest::class);
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category]['label'] ?? ucfirst($this->category);
    }

    /** Contoh: "Rp 275.000" */
    public function getPriceRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
